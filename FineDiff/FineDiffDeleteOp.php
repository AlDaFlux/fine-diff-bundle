<?php

namespace Aldaflux\FineDiffBundle\FineDiff;

class FineDiffDeleteOp implements FineDiffOp
{
    /**
     * @var int
     */
    private $fromLen;

    /**
     * FineDiffDeleteOp constructor.
     * @param int $len
     */
    public function __construct($len)
    {
        $this->fromLen = $len;
    }

    /**
     * @inheritdoc
     */
    public function getFromLen()
    {
        return $this->fromLen;
    }

    /**
     * @inheritdoc
     */
    public function getToLen()
    {
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function getOpcode()
    {
        if ($this->fromLen === 1) {
            return 'd';
        }
        return "d{$this->fromLen}";
    }
}