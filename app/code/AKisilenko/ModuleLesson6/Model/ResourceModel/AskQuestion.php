<?php

namespace AKisilenko\ModuleLesson6\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AskQuestion extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('ask_question', 'ask_id');
    }
}
