<?php
namespace AKisilenko\Kmodule\Controller\Demonstration;
use Magento\Framework\Controller\ResultFactory;
class JsonResponse extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $controllerResult */
        $controllerResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $dataRouter = ['myRoute' => "Default Router Is"];
        return $controllerResult->setData($dataRouter);
    }
}