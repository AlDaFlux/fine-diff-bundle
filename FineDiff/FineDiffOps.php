<?php

namespace Aldaflux\FineDiffBundle\FineDiff;

/**
 * FineDiff ops
 *
 * Collection of ops
 */
class FineDiffOps
{
    /**
     * @param string $opcode
     * @param string $from
     * @param int $from_offset
     * @param int $from_len
     */
    public function appendOpcode($opcode, $from, $from_offset, $from_len)
    {
        if ($opcode === 'c') {
            $edits[] = new FineDiffCopyOp($from_len);
        } else if ($opcode === 'd') {
            $edits[] = new FineDiffDeleteOp($from_len);
        } else /* if ( $opcode === 'i' ) */ {
            $edits[] = new FineDiffInsertOp(mb_substr($from, $from_offset, $from_len));
        }
    }

    public $edits = array();
}