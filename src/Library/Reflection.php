<?php

namespace SimpleLibraries\Library;

use ReflectionObject;
use ReflectionProperty;

/**
 * Reflections
 */
class Reflection {

    /**
     * Ger all public variables list from objects
     * @param Object $object
     * @return array
     */
    public static function getPublicPropertyList(Object $object) : array {
        $return = [];
        $reflection = new ReflectionObject($object);

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) AS $property)  {
            $key = $property->getName();
            $value = $property->getValue($object);

            $return[$key] = is_object($value) ? self::getPublicPropertyList($value) : $value;
        }

        return $return;
    }

}