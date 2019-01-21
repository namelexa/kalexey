<?php

namespace AKisilenko\ModuleLesson6\Model\ResourceModel;

class AskQuestion extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('ask_question', 'ask_id');
    }
}