<?php

namespace ValueObjects\Person;

use ValueObjects\Basics\StringValueObject;
use ValueObjects\Utils;
use ValueObjects\ValueObjectInterface;

class FullNameValueObject implements ValueObjectInterface
{
    /**
     * Name
     *
     * @var \ValueObjects\Basics\StringValueObject
     */
    private $name;

    /**
     * First Surname
     *
     * @var \ValueObjects\Basics\StringValueObject
     */
    private $firstSurname;

    /**
     * Second Surname
     *
     * @var \ValueObjects\Basics\StringValueObject
     */
    private $secondSurname;

    /**
     * Returns a Name objects form PHP native values
     *
     * @param  string $name
     * @param  string $firstSurname
     * @param  string $secondSurname
     * @return NameValueObject
     */
    public static function fromNative()
    {
        $args = func_get_args();

        $name          = new StringValueObject($args[0]);
        $firstSurname  = new StringValueObject($args[1]);
        $secondSurname = new StringValueObject($args[2]);

        return new static($name, $firstSurname, $secondSurname);
    }

    /**
     * Returns a Name object
     *
     * @param StringValueObject $first_name
     * @param StringValueObject $middle_name
     * @param StringValueObject $last_name
     */
    public function __construct(
        StringValueObject $name, 
        StringValueObject $first_surname, 
        StringValueObject $second_surname)
    {
        $this->name          = $name;
        $this->firstSurname  = $first_surname;
        $this->secondSurname = $second_surname;
    }

    /**
     * Returns the name
     *
     * @return StringValueObject
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Returns the first surname
     *
     * @return StringValueObject
     */
    public function firstSurname()
    {
        return $this->middleName;
    }

    /**
     * Returns the second surname
     *
     * @return StringValueObject
     */
    public function secondSurname()
    {
        return $this->lastName;
    }

    /**
     * Returns the full name
     *
     * @return StringValueObject
     */
    public function fullName()
    {
        $fullNameString = $this->name .
            ($this->firstSurname->isEmpty() ? '' : ' ' . $this->firstSurname) .
            ($this->secondSurname->isEmpty() ? '' : ' ' . $this->secondSurname);

        $fullName = new StringValueObject($fullNameString);

        return $fullName;
    }

    /**
     * Tells whether two names are equal by comparing their values
     *
     * @param  ValueObjectInterface $name
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $name)
    {
        if (false === Utils::classEquals($this, $name)) {
            return false;
        }

        return $this->fullName() == $name->fullName();
    }

    /**
     * Returns the full name
     *
     * @return string
     */
    public function __toString()
    {
        return \strval($this->fullName());
    }
}