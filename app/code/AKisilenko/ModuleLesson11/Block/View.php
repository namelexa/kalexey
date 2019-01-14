<?php

namespace AKisilenko\ModuleLesson11\Block;

use AKisilenko\ModuleLesson11\Model\ConstructExample;
use AKisilenko\ModuleLesson11\Model\FileList;

/**
 * Class View
 * @package AKisilenko\ModuleLesson11\Block
 */
class View extends \Magento\Framework\View\Element\Template
{
    public $constructExampleModel;
    public $fileListModel;

    /**
     * View constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param ConstructExample $constructExample
     * @param FileList $fileList
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ConstructExample $constructExample,
        FileList $fileList,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->constructExampleModel = $constructExample;
        $this->fileListModel = $fileList;
    }

    /**
     * @return ConstructExample|FileList
     */
    public function getInjectObject()
    {
        return $this->constructExampleModel;
    }

    public function getFileListObject()
    {
        return $this->fileListModel;
    }
}