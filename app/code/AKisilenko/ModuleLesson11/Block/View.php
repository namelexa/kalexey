<?php

namespace AKisilenko\ModuleLesson11\Block;

use AKisilenko\ModuleLesson11\Model\ConstructExample;
use AKisilenko\ModuleLesson11\Model\FileList;
use AKisilenko\ModuleLesson11\Model\ReflectionExample;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class View
 * @package AKisilenko\ModuleLesson11\Block
 */
class View extends Template
{
    private $constructExampleModel;
    private $fileListModel;
    private $reflectionExampleModel;

    /**
     * View constructor.
     * @param Context $context
     * @param ConstructExample $constructExample
     * @param FileList $fileList
     * @param ReflectionExample $reflectionExample
     * @param array $data
     */
    public function __construct(
        Context $context,
        ConstructExample $constructExample,
        FileList $fileList,
        ReflectionExample $reflectionExample,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->constructExampleModel = $constructExample;
        $this->fileListModel = $fileList;
        $this->reflectionExampleModel = $reflectionExample;
    }

    /**
     * @return ConstructExample
     */
    public function getInjectObject()
    {
        return $this->constructExampleModel;
    }

    /**
     * @return FileList
     */
    public function getFileListObject(): FileList
    {
        return $this->fileListModel;
    }

    /**
     * @return ReflectionExample
     */
    public function getReflectionExampleObject(): ReflectionExample
    {
        return $this->reflectionExampleModel;
    }
}
