<?php

namespace AKisilenko\ModuleLesson11\Model;

class ConstructExample
{
    /**
     * @var
     */
    public $stringParam;
    public $instanceParam;
    public $boolParam;
    public $intParam;
//    public $globalInitParam;
//    public $constantParam;
    public $optionalParam;
    public $arrayParam;

    public function __construct(
        $stringParam,
        $instanceParam,
        $boolParam,
        $intParam,
//        $globalInitParam,
//        $constantParam,
        $optionalParam,
        $arrayParam
    ) {
        $this->stringParam = $stringParam;
        $this->instanceParam = $instanceParam;
        $this->boolParam = $boolParam;
        $this->intParam = $intParam;
//        $this->globalInitParam = $globalInitParam;
//        $this->constantParam = $constantParam;
        $this->optionalParam = $optionalParam;
        $this->arrayParam = $arrayParam;
    }
}
