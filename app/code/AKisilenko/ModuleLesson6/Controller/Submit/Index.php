<?php
namespace AKisilenko\ModuleLesson6\Controller\Submit;

use AKisilenko\ModuleLesson6\Api\Data\AskQuestionInterface;
use AKisilenko\ModuleLesson6\Api\AskQuestionRepositoryInterface;
use AKisilenko\ModuleLesson6\Model\AskQuestion;
use AKisilenko\ModuleLesson6\Model\AskQuestionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Exception\LocalizedException;
use AKisilenko\ModuleLesson6\Helper\Mail;

class Index extends Action
{
    const STATUS_ERROR = 'Error';
    const STATUS_SUCCESS = 'Success';

    /**
     * @var Validator
     */
    private $formKeyValidator;

    /**
     * @var AskQuestionFactory
     */
    private $askQuestionFactory;

    /**
     * @var Mail
     */
    private $mailHelper;

    /**
     * @var
     */
    private $askQuestionRepository;

    /**
     * Index constructor.
     * @param Validator $formKeyValidator
     * @param AskQuestionFactory $askQuestionFactory
     * @param Mail $mailHelper
     * @param AskQuestionRepositoryInterface $askQuestionRepository
     * @param Context $context
     */
    public function __construct(
        Validator $formKeyValidator,
        AskQuestionFactory $askQuestionFactory,
        Mail $mailHelper,
        AskQuestionRepositoryInterface $askQuestionRepository,
        Context $context
    ) {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
        $this->askQuestionFactory = $askQuestionFactory;
        $this->mailHelper = $mailHelper;
        $this->askQuestionRepository = $askQuestionRepository;
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $request = $this->getRequest();
        try {
            if (!$this->formKeyValidator->validate($request) || $request->getParam('hideit')) {
                throw new LocalizedException(__('Something went wrong. Probably you were away for quite a long time already. Please, reload the page and try again.'));
            }
            if (!$request->isAjax()) {
                throw new LocalizedException(__('This request is not valid and can not be processed.'));
            }
            $askQuestion = $this->askQuestionFactory->create();
            $askQuestion
                ->setName($request->getParam('name'))
                ->setEmail($request->getParam('email'))
                ->setTelephone($request->getParam('telephone'))
                ->setComment($request->getParam('comment'))
                ->setStoreId($request->getParam('store'));
            $this->requestSampleRepository->save($askQuestion);

            /**
             * Send Email
             */
            if ($request->getParam('email')) {
                $email = $request->getParam('email');
                $customerName = $request->getParam('name');
                $message = $request->getParam('comment');
                $this->mailHelper->sendMail($email, $customerName, $message);
            }
            if (!$request->getParam('time_cookie')) {
                $data = [
                    'status' => self::STATUS_ERROR,
                    'message' => 'A message may be sent no more than once every 2 minutes.'
                ];
            } else {
                $data = [
                    'status' => self::STATUS_SUCCESS,
                    'message' => 'Your request was submitted.'
                ];
            }
        } catch (LocalizedException $e) {
            $data = [
                'status'  => self::STATUS_ERROR,
                'message' => $e->getMessage()
            ];
        }
        /**
         * @var Json $controllerResult
         */
        $controllerResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $controllerResult->setData($data);
    }
}