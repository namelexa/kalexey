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
use AKisilenko\ModuleLesson6\Api\Data\AskQuestionInterface;

/**
 * Class AskQuestion
 * @package AKisilenko\ModuleLesson6\Model
 */
class AskQuestion extends AbstractModel implements AskQuestionInterface
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';

    public function getId()
    {
        return $this->getData('ask_id');
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData('ask_id', $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->getData('email');
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        return $this->setData('email', $email);
    }

    /**
     * {@inheritdoc}
     */
    public function getPhone()
    {
        return $this->getData('phone');
    }

    /**
     * {@inheritdoc}
     */
    public function setPhone($phone)
    {
        return $this->setData('phone', $phone);
    }

    /**
     * {@inheritdoc}
     */
    public function getComment()
    {
        return $this->getData('comment');
    }

    /**
     * {@inheritdoc}
     */
    public function setComment($comment)
    {
        return $this->setData('comment', $comment);
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->getData('status');
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreId()
    {
        return $this->getData('store_id');
    }

    /**
     * {@inheritdoc}
     */
    public function setStoreId($storeId)
    {
        return $this->setData('store_id', $storeId);
    }

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @param Context $context
     * @param Registry $registry
     * @param StoreManagerInterface $storeManager
     * @param AbstractResource $resource
     * @param AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        StoreManagerInterface $storeManager,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
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
     * @return AbstractModel
     * @throws NoSuchEntityException
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
