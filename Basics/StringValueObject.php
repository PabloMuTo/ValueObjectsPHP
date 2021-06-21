<?php

namespace ValueObjects\Basics;

use ValueObjects\Exception\InvalidArgumentException;
use ValueObjects\Utils;
use ValueObjects\ValueObjectInterface;

class StringValueObject implements ValueObjectInterface
{
    protected $value;

    /**
     * Returns a StringValueObject object given a PHP native string as parameter.
     *
     * @param  string $value
     * @return StringLiteral
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);
        return new static($value);
    }

    /**
     * Returns a StringValueObject object
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (false === \is_string($value)) {
            throw new InvalidArgumentException($value, array('string'));
        }
        $this->value = $value;
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Checks if has same value
     *
     * @param  ValueObjectInterface $stringLiteral
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $stringValueObject)
    {
        if (false === Utils::classEquals($this, $stringValueObject)) {
            return false;
        }
        return $this->toNative() === $stringValueObject->toNative();
    }

    /**
     * Checks if this Value Object is empty
     * @return bool
     */
    public function isEmpty()
    {
        return \strlen($this->toNative()) == 0;
    }

    /**
     * Returns the string value 
     * @return string
     */
    public function __toString()
    {
        return $this->toNative();
    }
}