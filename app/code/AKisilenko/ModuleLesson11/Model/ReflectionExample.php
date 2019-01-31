<?php

declare(strict_types=1);

namespace AKisilenko\ModuleLesson11\Model;

/**
 * Class ReflectionExample
 * @package AKisilenko\ModuleLesson11\Model
 */
class ReflectionExample
{
    const PARENT1 = 'PARENT1';
    const PARENT2 = 'PARENT2';
    const MY_CLASS = 'My class';

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getMethods(): array
    {
        $item = new  \ReflectionClass(__CLASS__);
        return $item->getMethods();
    }

}
