<?php
namespace AKisilenko\Kmodule\Controller\Demonstration;
use Magento\Framework\Controller\ResultFactory;
class ShowPerson extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */

    public function execute()
    {
        $name = "Lexa";
        $lastName = "Kisilenko";
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getLayout()-> getBlock('lesson3.custom.block')->setName($name)->setLastName($lastName);

        return $resultPage;

    }
}