<?php

namespace AKisilenko\ModuleLesson11\Controller\Result;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;


/**
 * Class Index
 * @package AKisilenko\ModuleLesson11\Controller\Result
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
