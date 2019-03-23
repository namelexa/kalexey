<?php
namespace AKisilenko\ModuleLesson6\Helper;

use Magento\Framework\App\Area;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\User\Model\UserFactory;

class Mail extends AbstractHelper
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var TransportBuilder
     */
    private $transportBuilder;
    /**
     * @var StateInterface
     */
    private $inlineTranslation;
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    private $userFactory;
    /**
     * Mail constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param ScopeConfigInterface $scopeConfig
     * @param UserFactory $userFactory
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        UserFactory $userFactory
    ) {
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->userFactory = $userFactory;
        parent::__construct($context);
    }

    /**
     * @param $emailFrom
     * @param string $customerName
     * @param $message
     * @throws MailException
     * @throws NoSuchEntityException
     */
    public function sendMail($emailFrom, $customerName = '', $message)
    {
        $templateOptions = [
            'area' => Area::AREA_FRONTEND,
            'store' => $this->storeManager->getStore()->getId()
        ];
        $templateVars = [
            'store' => $this->storeManager->getStore(),
            'name' => $customerName,
            'comment'   => $message
        ];

        /**
         * Send to Customer
         */
        $from = ['email' => $this->getAdminEmail(), 'name' => 'Admin'];
                $this->inlineTranslation->suspend();
        $to = [$this->getAdminEmail()];
        $transport = $this->transportBuilder->setTemplateIdentifier('ask_question_customer_email')
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($to)
            ->getTransport();
        $transport->sendMessage();

        /**
         * Send to Admin
         */
        $from = ['email' => $this->getAdminEmail(), 'name' => $customerName];
        $this->inlineTranslation->suspend();
        $to = [$emailFrom];
        $transport = $this->transportBuilder->setTemplateIdentifier('ask_question_admin_email')
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($to)
            ->getTransport();
        $transport->sendMessage();

        $this->inlineTranslation->resume();
    }
    /**
     * @return mixed|string
     */
    private function getAdminEmail()
    {
        $transEmailSaller = $this->scopeConfig->getValue(
            'trans_email/ident_sales/email',
            ScopeInterface::SCOPE_STORE
        );
        if ($transEmailSaller) {
            return $transEmailSaller;
        }
        $userFactory =  $this->userFactory->create();
        if ($userFactory) {
            $user = $userFactory->getById(1);
            return $user->getEmail();
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getEnableFlagEmailing()
    {
        return $this->scopeConfig->getValue(
            'ask_question_options/email_status/choose_email_status',
            ScopeInterface::SCOPE_STORES
        );
    }
}
