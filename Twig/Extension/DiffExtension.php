<?php

namespace Aldaflux\FineDiffBundle\Twig\Extension;

use Aldaflux\FineDiffBundle\FineDiff\FineDiff;
#use Twig_Extension;
#use Twig_SimpleFunction;
use Twig\TwigFunction;
use Aldaflux\FineDiffBundle\DependencyInjection\Configuration;

use Twig\Extension\AbstractExtension;


class DiffExtension extends AbstractExtension
{
    /**
     * @var array
     */
    protected $defaultGranularity;

    /**
     * DiffExtension constructor.
     * @param array $defaultGranularity
     */
    public function __construct(array $defaultGranularity)
    {
        $this->defaultGranularity = $defaultGranularity;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('renderDiff', [$this, 'getDiff'], ['is_safe' => ['html']]),
            new TwigFunction('renderHtmlTextDiff', [$this, 'getHtmlTextDiff'], ['is_safe' => ['html']]),
        ];
    }

    public function getDiff($old, $new, $granularity = null)
    {
        $granularity = $granularity
            ? $this->getGranularity($granularity)
            : $this->defaultGranularity;
        $opcodes = FineDiff::getDiffOpcodes($old, $new, $granularity);
        $html = FineDiff::renderDiffToHTMLFromOpcodes($old, $opcodes);

        return $html;
    }

    /**
     * @param $old
     * @param $new
     * @param null $granularity
     * @param array $filters    Eg: ['html_entity_decode'] If the data comes from CKEditor, there are some encoded
     *                          strings: &lt; But we want to see the original character: `<`
     * @return mixed
     */
    public function getHtmlTextDiff($old, $new, $granularity = null, $filters = [])
    {
        $old = strip_tags($old);
        $new = strip_tags($new);

        foreach ($filters as $filter) {
            $old = call_user_func_array($filter, [$old]);
            $new = call_user_func_array($filter, [$new]);
        }

        return $this->getDiff($old, $new, $granularity);
    }

    protected function getGranularity($name)
    {
        $granularities = Configuration::getGranularities();

        if (!array_key_exists($name, $granularities)) {
            throw new \InvalidArgumentException(sprintf(
                'Unknown granularity: `%s`. There are these: `%s`',
                $name,
                implode('`, `', array_keys($granularities))
            ));
        }

        return $granularities[$name];
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Aldaflux_fine_diff.twig_extension';
    }
}
