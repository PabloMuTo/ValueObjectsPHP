<?php

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidArgumentException;

class NaturalValueObject extends IntegerValueObject
{
    /**
     * Returns a Natural object given a PHP native int as parameter.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $options = array(
            'options' => array(
                'min_range' => 0
            )
        );

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidArgumentException($value, array('int (>=0)'));
        }

        parent::__construct($filteredValue);
    }
}