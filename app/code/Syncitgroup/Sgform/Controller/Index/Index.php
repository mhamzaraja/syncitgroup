<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Controller\Index;

use Syncitgroup\Sgform\Model\Formdata;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Escaper;
use Magento\Framework\ObjectManagerInterface as Objectmanager;


class Index extends Action
{

    protected $resultPageFactory;
    protected $_formdata;
    protected $resultFactory;
    protected $eventManager;


    protected $_transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;
    protected $storeManager;
    protected $_escaper;
    protected $objectManager;

    /**
     * Index constructor.
     * @param Context $context
     * @param Formdata $formdata
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Formdata  $formdata,
        PageFactory $resultPageFactory,
        ResultFactory $resultFactory,
        EventManager $eventManager,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        Escaper $escaper,
        Objectmanager $objectmanager
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_formdata = $formdata;
        $this->resultFactory = $resultFactory;
        $this->eventManager = $eventManager;
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->_escaper = $escaper;
        $this->objectManager = $objectmanager;
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $post = (array) $this->getRequest()->getPost();
        if (!empty($post)) {
            if (!empty($_SERVER['HTTP_CLIENT_IP']))  {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }else{
            $ip_address = $_SERVER['REMOTE_ADDR'];
          }

            $formData = [
                "name" => $post['name'],
                "age" => $post['age'],
                "sex" => $post['sex'],
                "message" => $post['message'],
                "email" => $post['email'],
                "ip_address" => $ip_address
                ];

            $storeEmail = $this->scopeConfig->getValue('trans_email/ident_sales/email',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);

            $storeName = $this->scopeConfig ->getValue('trans_email/ident_general/name',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);


            $postObject = new \Magento\Framework\DataObject();
            $postObject->setData($post);
            $error = false;

            $sender = [
                'name' => $this->_escaper->escapeHtml($post['name']),
                'email' => "mhamzak3@gmail.com",
            ];

            $transport = $this->_transportBuilder->setTemplateIdentifier('send_email_custom_template')
            ->setTemplateOptions(
                [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                ]
            )
                ->setTemplateVars($formData)
                ->setFrom($sender)
                ->addTo($storeEmail,$storeName)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            
            $model = $this->objectManager->create(Formdata::class);

            $model->addData($formData);

            $saveData = $model->save();
            if($saveData){
                $this->eventManager->dispatch('syncit_group_form', ['email' => $post['email']]);
                $this->messageManager->addSuccess( __('Thank you for submitting to Syncit Group custom form!') );
            }
        }

        
        return $this->resultPageFactory->create();
    }

}
