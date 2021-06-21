<?php

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidArgumentException;
use ValueObjects\Utils;
use ValueObjects\ValueObjectInterface;

class IntegerValueObject extends RealNumberValueObject
{
    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_INT);

        if (false === $filteredValue) {
            throw new InvalidArgumentException($value, array('int'));
        }

        parent::__construct($filteredValue);
    }

    /**
     * Compare two Integers by value. Checks if both are equals
     *
     * @param  ValueObjectInterface $integer
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $integer)
    {
        if (false === Utils::classEquals($this, $integer)) {
            return false;
        }

        return $this->toNative() === $integer->toNative();
    }

    /**
     * Returns the value
     * @return int
     */
    public function toNative()
    {
        $value = parent::toNative();
        return \intval($value);
    }

    /**
     * Returns a RealValueObject with the value of the Integer
     *
     * @return Real
     */
    public function toReal()
    {
        $value = $this->toNative();
        return new RealNumberValueObject($value);
    }
}