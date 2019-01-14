<?php

declare(strict_types=1);

namespace AKisilenko\ModuleLesson11\Model\ReflectionExample;

use ReflectionClass;
use ReflectionMethod;

class ReflectionExample
{

    const PARENT1 = 'PARENT1';
    const PARENT2 = 'PARENT2';
    /**
     * @return array
     * @throws \ReflectionException
     */
    const MY_CLASS = 'My class';
    public function getConstants():array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * @return \ReflectionMethod[]
     * @throws \ReflectionException
     */
    public function getMethods():array
    {
        $item = new  ReflectionClass(__CLASS__);
        return $item->getMethods();
    }

}



