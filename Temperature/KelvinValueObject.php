<?php

namespace ValueObjects\Temperature;

class KelvinValueObject extends TemperatureValueObject
{
    /**
     * @return Celsius
     */
    public function toCelsius()
    {
        return new CelsiusValueObject($this->value - 273.15);
    }

    /**
     * @return Kelvin
     */
    public function toKelvin()
    {
        return new static($this->value);
    }

    /**
     * @return Fahrenheit
     */
    public function toFahrenheit()
    {
        return new FahrenheitValueObject($this->toCelsius()->toNative() * 1.8 + 32);
    }
}