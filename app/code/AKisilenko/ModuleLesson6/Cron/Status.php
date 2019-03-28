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
//        Config $config,
        CollectionFactory $askQuestionsFactory
    ) {
//        $this->dateQuantity = $config;
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->askFactory = $askQuestionsFactory;
    }

    /**
     * @param string $key
     * @param string $section
     * @return mixed
     */
    private function isEnabled($key = 'enable_cron', $section = 'cron')
    {
        return $this->scopeConfig
            ->getValue(
                "ask_question_options/$section/$key",
                ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @param string $key
     * @param string $section
     * @return mixed
     */
    private function getDaysQuantity($key = 'frequency', $section = 'cron')
    {
        return $this->scopeConfig
            ->getValue(
                "ask_question_options/$section/$key",
                ScopeInterface::SCOPE_STORES
            );
    }

    public function execute()
    {
        if ($this->isEnabled() == 1) {
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
