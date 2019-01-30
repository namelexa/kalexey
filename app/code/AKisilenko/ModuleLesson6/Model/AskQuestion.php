<?php

namespace AKisilenko\ModuleLesson6\Model;

use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion as AskQuestionResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class AskQuestion
 * @package AKisilenko\ModuleLesson6\Model
 *
 * @method int|string getAskId()
 * @method int|string getName()
 * @method AskQuestion setName(string $name)
 * @method string getEmail()
 * @method AskQuestion setEmail(string $email)
 * @method string getTelephone()
 * @method AskQuestion setTelephone(string $phone)
 * @method string getComment()
 * @method AskQuestion setComment(string $question)
 * @method string getRequest()
 * @method AskQuestion setRequest(string $request)
 * @method string getCreatedAt()
 * @method string getStatus()
 * @method AskQuestion setStatus(string $status)
 * @method int|string getStoreId()
 * @method AskQuestion setStoreId(int $storeId)
 */
class AskQuestion extends AbstractModel
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';

//    /**
//     * @var StoreManagerInterface
//     */
//    private $storeManager;
//    /**
//     * @param Context $context
//     * @param Registry $registry
//     * @param StoreManagerInterface $storeManager
//     * @param AbstractResource $resource
//     * @param AbstractDb $resourceCollection
//     * @param array $data
//     */
//    public function __construct(
//        Context $context,
//        Registry $registry,
//        StoreManagerInterface $storeManager,
//        AbstractResource $resource = null,
//        AbstractDb $resourceCollection = null,
//        array $data = []
//    ) {
//        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
//        $this->storeManager = $storeManager;
//    }
    /**
     * @inheritdoc
     */
    protected function _construct()
    {

        $this->_init(AskQuestionResource::class);
    }

//    /**
//     * @return AbstractModel
//     * @throws NoSuchEntityException
//     */
//    public function beforeSave()
//    {
//        if (!$this->getStatus()) {
//            $this->setStatus(self::STATUS_PENDING);
//        }
//        if (!$this->getStoreId()) {
//            $this->setStoreId($this->storeManager->getStore()->getId());
//        }
//        return parent::beforeSave();
//    }

}
