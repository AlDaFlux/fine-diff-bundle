<?php

namespace Greywolfs\Bundle\FineDiffBundle\FineDiff;

class FineDiffReplaceOp implements FineDiffOp
{
    /**
     * @var int
     */
    private $fromLen;

    /**
     * @var string
     */
    private $text;

    /**
     * FineDiffReplaceOp constructor.
     * @param int $fromLen
     * @param string $text
     */
    public function __construct($fromLen, $text)
    {
        $this->fromLen = $fromLen;
        $this->text = $text;
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
        return strlen($this->text);
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @inheritdoc
     */
    public function getOpcode()
    {
        if ($this->fromLen === 1) {
            $del_opcode = 'd';
        } else {
            $del_opcode = "d{$this->fromLen}";
        }
        $to_len = strlen($this->text);
        if ($to_len === 1) {
            return "{$del_opcode}i:{$this->text}";
        }
        return "{$del_opcode}i{$to_len}:{$this->text}";
    }
}