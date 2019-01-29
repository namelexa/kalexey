<?php

namespace AKisilenko\ModuleLesson6\Controller\Adminhtml\Earningrates;

use Magento\Backend\App\Action\Context;
use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\Collection;

/**
 * Class MassDelete
 */
class MassStatus extends AbstractMassAction
{
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context, $filter, $collectionFactory);
    }

    /**
     * @param AbstractCollection $collection
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    protected function massAction(Collection $collection)
    {
        $rateChangeStatus = 0;
        foreach ($collection as $rate) {
            $rate->setStatus($this->getRequest()->getParam('status'))->save();
            $rateChangeStatus++;
        }

        if ($rateChangeStatus) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', $rateChangeStatus));
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AKisilenko_ModuleLesson6::Earning_Rates');
    }

}
?>