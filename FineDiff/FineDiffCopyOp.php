<?php

namespace Greywolfs\Bundle\FineDiffBundle\FineDiff;

class FineDiffCopyOp implements FineDiffOp
{
    /**
     * @var int
     */
    private $len;

    /**
     * FineDiffCopyOp constructor.
     * @param $len
     */
    public function __construct($len)
    {
        $this->len = $len;
    }

    /**
     * @inheritdoc
     */
    public function getFromLen()
    {
        return $this->len;
    }

    /**
     * @inheritdoc
     */
    public function getToLen()
    {
        return $this->len;
    }

    /**
     * @inheritdoc
     */
    public function getOpcode()
    {
        if ($this->len === 1) {
            return 'c';
        }
        return "c{$this->len}";
    }

    /**
     * @param int $size
     * @return int
     */
    public function increase($size)
    {
        return $this->len += $size;
    }
}