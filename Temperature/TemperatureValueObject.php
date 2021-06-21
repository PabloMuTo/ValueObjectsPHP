<?php

namespace ValueObjects\Temperature;

use ValueObjects\Number\RealNumberValueObject;

abstract class TemperatureValueObject extends RealNumberValueObject
{
    /**
     * @return Celsius
     */
    abstract public function toCelsius();

    /**
     * @return Kelvin
     */
    abstract public function toKelvin();

    /**
     * @return Fahrenheit
     */
    abstract public function toFahrenheit();
}