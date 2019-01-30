<?php

namespace AKisilenko\ModuleLesson6\Controller\Adminhtml\Ask;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\Collection;

/**
 * Class MassStatus
 * @package AKisilenko\ModuleLesson6\Controller\Adminhtml\Ask
 */
class MassStatus extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * MassStatus constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @param Collection $collection
     * @return Redirect
     * @throws LocalizedException
     */
    public function execute()
    {
        $statusValue = $this->getRequest()->getParam('status');
        $selected = $this->getRequest()->getPostValue('selected'); /** var $selected receive needed id's from listing*/
//        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $collection = $this->collectionFactory->create();

            foreach ($collection as $item) {
                $item->setStatus($statusValue);
                $item->save();
            }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been modified.', $collection->getSize()));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }


}
