<?php

namespace ValueObjects\Number;

class RoundingMode
{
    const HALF_UP   = PHP_ROUND_HALF_UP;
    const HALF_DOWN = PHP_ROUND_HALF_DOWN;
    const HALF_EVEN = PHP_ROUND_HALF_EVEN;
    const HALF_ODD  = PHP_ROUND_HALF_ODD;
}