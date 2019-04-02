<?php
namespace AKisilenko\ModuleLesson6\Block;

use Magento\Catalog\Block\Product\View;

class AskForm extends View
{
    /**
     * @return int
     */
    public function getCurrentCustomerId(): int
    {
        $currentCustomer = $this->customerSession->getCustomer();
        return $currentCustomer ? (int) $currentCustomer->getId() : 0;
    }
}