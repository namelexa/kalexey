<?php
namespace Geekhub\CustomerOrder\Controller\Customer;

/**
 * Class Order
 * @package Geekhub\CustomerOrder\Controller\Customer
 */
class Order extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
    }
}