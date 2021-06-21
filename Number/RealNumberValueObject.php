  
<?php

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidArgumentException;
use ValueObjects\Utils;
use ValueObjects\ValueObjectInterface;

class RealNumberValueObject implements ValueObjectInterface
{
    protected $value;

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param  float  $value
     * @return static
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float $value
     */
    public function __construct($value)
    {
        $filteredValue = \filter_var($value, FILTER_VALIDATE_FLOAT);

        if (false === $filteredValue) {
            throw new InvalidArgumentException($value, array('float'));
        }

        $this->value = $filteredValue;
    }

    /**
     * Returns the native value of the real number
     *
     * @return float
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Checks if two RealNumbers are equal by comparing their values
     *
     * @param  ValueObjectInterface $real
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $real)
    {
        if (false === Utils::classEquals($this, $real)) {
            return false;
        }

        return $this->toNative() === $real->toNative();
    }

    /**
     * Returns the integer part of the Real number as a Integer
     *
     * @param  RoundingMode $rounding_mode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     * @return Integer
     */
    public function toInteger(RoundingMode $rounding_mode = null)
    {
        if (null === $rounding_mode) {
            $rounding_mode = RoundingMode::HALF_UP;
        }

        $value        = $this->toNative();
        $integerValue = \round($value, 0, $rounding_mode);
        return new IntegerValueObject($integerValue);
    }

    /**
     * Returns the absolute integer part of the Real number as a Natural
     *
     * @param  RoundingMode $rounding_mode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     * @return Natural
     */
    public function toNatural(RoundingMode $rounding_mode = null)
    {
        $integerValue = $this->toInteger($rounding_mode)->toNative();
        $naturalValue = \abs($integerValue);
        return new NaturalValueObject($naturalValue);
    }

    /**
     * Returns the string representation of the real value
     *
     * @return string
     */
    public function __toString()
    {
        return \strval($this->toNative());
    }
}