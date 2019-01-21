<?php

namespace AKisilenko\ModuleLesson6\Model;

use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion as AskQuestionResource;

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
class AskQuestion extends \Magento\Framework\Model\AbstractModel
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->storeManager = $storeManager;
    }
    /**
     * @inheritdoc
     */
    protected function _construct()
    {

        $this->_init(AskQuestionResource::class);
    }

    /**
     * @return \Magento\Framework\Model\AbstractModel
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSave()
    {
        if (!$this->getStatus()) {
            $this->setStatus(self::STATUS_PENDING);
        }
        if (!$this->getStoreId()) {
            $this->setStoreId($this->storeManager->getStore()->getId());
        }
        return parent::beforeSave();
    }

}
