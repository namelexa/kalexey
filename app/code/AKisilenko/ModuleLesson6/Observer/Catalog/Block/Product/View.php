<?php

namespace Akisilenko\ModuleLesson6\Observer\Catalog\Block\Product;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;

class View implements ObserverInterface
{
    const LAYOUT_HANDLE = 'catalog_product_view';

    /**
     * @var Registry
     */
    private $registry;

    /**
     * View constructor.
     * @param Registry $registry
     */
    public function __construct(
        Registry $registry
    ) {
        $this->registry = $registry;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        $actionName = $observer->getEvent()->getData('full_action_name');
        $product = $this->registry->registry('current_product');
        $layout = $observer->getEvent()->getData('layout');

        if ($product && $actionName !== 'catalog_product_view' && $product->getAllowToAskQuestions()) {
            $layout->getUpdate()->addHandle(static::LAYOUT_HANDLE);
        }

        return $this;
    }
}
