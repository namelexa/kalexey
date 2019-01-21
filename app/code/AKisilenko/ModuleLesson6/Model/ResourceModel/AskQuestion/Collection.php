<?php

namespace AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \AKisilenko\ModuleLesson6\Model\AskQuestion::class,
            \AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion::class
        );
    }
}
