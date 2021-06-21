<?php

namespace ValueObjects\Temperature;

class FahrenheitValueObject extends TemperatureValueObject
{
    /**
     * @return Celsius
     */
    public function toCelsius()
    {
        return new CelsiusValueObject(($this->value - 32) / 1.8);
    }

   