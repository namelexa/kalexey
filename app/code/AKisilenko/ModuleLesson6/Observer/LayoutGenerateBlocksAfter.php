<?php
namespace AKisilenko\ModuleLesson6\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;

/**
 * Class LayoutGenerateBlocksAfter
 * @package AKisilenko\ModuleLesson6\Observer
 */
class LayoutGenerateBlocksAfter implements ObserverInterface
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * LayoutGenerateBlocksAfter constructor.
     * @param Registry $registry
     * @param Session $customerSession
     */
    public function __construct(
        Registry $registry,
        Session $customerSession
    ) {
        $this->registry = $registry;
        $this->customerSession = $customerSession;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        $product = $this->registry->registry('current_product');
        if (!$product) {
            return $this;
        }
        if ($this->requestFormDisallowed() == null) {
            $layout = $observer->getLayout();
            $sampleRequestBlock = $layout->getBlock('tab.ask.question');
            if ($sampleRequestBlock) {
                $sampleRequestBlock->setTemplate('');
            }
        }
        return $this;
    }
    /**
     * @return bool
     */
    private function requestFormDisallowed()
    {
        return $this->customerSession->getCustomer()->getData('group_id');
    }
}
