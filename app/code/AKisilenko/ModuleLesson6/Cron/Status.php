<?php
namespace AKisilenko\ModuleLesson6\Cron;

use AKisilenko\ModuleLesson6\Model\AskQuestion;
use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\CollectionFactory;
use Psr\Log\LoggerInterface;

/**
 * Class Status
 * @package AKisilenko\ModuleLesson6\Cron
 */
class Status
{
    const DAYS_QUANTITY = 3;

    protected $askFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Status constructor.
     * @param LoggerInterface $logger
     * @param CollectionFactory $askQuestionsFactory
     */
    public function __construct(
        LoggerInterface $logger,
        CollectionFactory $askQuestionsFactory
    ) {
        $this->logger = $logger;
        $this->askFactory = $askQuestionsFactory;
    }

    /**
     * @return mixed
     */
    protected function getDaysQuantity()
    {
        return self::DAYS_QUANTITY;
    }

    public function execute()
    {
        $currentDate = date('Y-m-d h:i:s');
        $filterDateTime = strtotime('-' . $this->getDaysQuantity() . ' day', strtotime($currentDate));
        $filterDate = date('Y-m-d h:i:s', $filterDateTime);

        $askQuestions = $this->askFactory->create();
        $collection = $askQuestions
            ->addFieldToFilter('status', ['eq' => AskQuestion::STATUS_PENDING])
            ->addFieldToFilter('created_at', ['lt' => $filterDate]);

        foreach ($collection as $item) {
            $item->setStatus(AskQuestion::STATUS_PROCESSED)->save();
        }
        $this->logger->critical('Test status');
    }
}
