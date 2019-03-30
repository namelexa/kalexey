<?php
namespace AKisilenko\ModuleLesson6\Controller\Customer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

/**
 * Class Question
 * @package AKisilenko\ModuleLesson6\Controller\Customer
 */
class Question extends Action
{
    /**
     * Question constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('My Questions'));
        $this->_view->renderLayout();
    }
}