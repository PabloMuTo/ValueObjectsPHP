<?php

namespace ValueObjects\Temperature;

use ValueObjects\Temperature\TemperatureValueObject;

class CelsiusValueObject extends TemperatureValueObject
{
    /**
     * @return Celsius
     */
    public function toCelsius()
    {
        return new static($this->value);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin()
    {
        return new Kelvin($this->value + 273.15);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit()
    {
        return new FahrenheitValueObject($this->value * 1.8 + 32);
    }
}