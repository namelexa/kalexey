<?php
namespace AKisilenko\ModuleLesson6\Cron;

use AKisilenko\ModuleLesson6\Model\AskQuestion;
use AKisilenko\ModuleLesson6\Model\ResourceModel\AskQuestion\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface;
use Magento\Store\Model\ScopeInterface;
use AKisilenko\ModuleLesson6\Helper\Config;

/**
 * Class Status
 * @package AKisilenko\ModuleLesson6\Cron
 */
class Status
{
    const XML_PATH_ASK_QUESTION_CRON_IS_ENABLED = 'ask_question_options/cron/enable_cron';
    const XML_PATH_ASK_QUESTION_CRON_FREQUENCY = 'ask_question_options/cron/frequency';

    /**
     * @var
     */
    protected $scopeConfig;

    /**
     * @var CollectionFactory
     */
    protected $askFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Status constructor.
     * @param LoggerInterface $logger
     * @param ScopeConfigInterface $scopeConfig
     * @param CollectionFactory $askQuestionsFactory
     */
    public function __construct(
        LoggerInterface $logger,
        ScopeConfigInterface $scopeConfig,
        CollectionFactory $askQuestionsFactory
    ) {
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->askFactory = $askQuestionsFactory;
    }

    /**
     * @return mixed
     */
    private function isCronEnabled()
    {
        return $this->scopeConfig
            ->getValue(
                self::XML_PATH_ASK_QUESTION_CRON_IS_ENABLED,
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return mixed
     */
    private function getDaysQuantity()
    {
        return $this->scopeConfig
            ->getValue(
                self::XML_PATH_ASK_QUESTION_CRON_FREQUENCY,
                ScopeInterface::SCOPE_STORES
            );
    }

    public function execute()
    {
        if ($this->isCronEnabled() == 1) {
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
            $this->logger->critical('Change status completed');
        } else {
            $this->logger->critical('Change status is off');
        }
    }
}
