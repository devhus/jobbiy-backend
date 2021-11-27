<?php
namespace App\Helpers;

use ReflectionClass;

class EnumBase
{
    /**
     * returns array of the enum values
     *
     * @return array
     */
    public static function toArray()
    {
        $oClass = new ReflectionClass(static::class);
        return $oClass->getConstants();
    }

    /**
     * returns array of the enum values
     *
     * @return array
     */
    public static function values()
    {
        return array_values(self::toArray());
    }

    /**
     * returns array of the enum keys
     *
     * @return array
     */
    public static function keys()
    {
        return array_keys(self::toArray());
    }
}
