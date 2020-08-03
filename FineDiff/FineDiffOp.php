<?php

namespace AlDaFlux\FineDiffBundle\FineDiff;

interface FineDiffOp
{
    /**
     * @return int
     */
    public function getFromLen();

    /**
     * @return int
     */
    public function getToLen();

    /**
     * @return string
     */
    public function getOpcode();
}