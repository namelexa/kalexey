<?php

namespace AKisilenko\ModuleLesson6\Block;

use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\Collection;
use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Exception\LocalizedException;

class Requests extends Template
{
    const CUSTOMERS_LIMIT = 10;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    private $customerSession;

    /**
     * Requests constructor.
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->customerSession = $customerSession;
    }

    /**
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function getSampleRequests(): Collection
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection
            ->addStoreFilter()
            ->getSelect()
            ->orderRand();
        if ($limit = $this->getData('limit')) {
            $collection->setPageSize($limit);
        }
        return $collection;
    }

    /**
     * @param \Magento\Customer\Model\Customer $customer
     * @return Collection
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getSampleRequestsByCustomer(\Magento\Customer\Model\Customer $customer): Collection
    {
        if (!$customer->getId()) {
            throw new LocalizedException(__('No customer has been found!'));
        }
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addStoreFilter()
            ->getSelect()
            ->orderRand();
        $collection->addFieldToFilter('customer_id', ['eq' => $customer->getId()]);
        $limit = $this->getData('limit') ?: self::CUSTOMERS_LIMIT;
        $collection->setPageSize($limit);
        return $collection;
    }

    /**
     * @return Collection
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getMySampleRequests()
    {
        $currentCustomer = $this->customerSession->getCustomer();
        return $this->getSampleRequestsByCustomer($currentCustomer);
    }
}
