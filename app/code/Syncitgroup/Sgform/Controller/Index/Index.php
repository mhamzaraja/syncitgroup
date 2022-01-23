<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Controller\Index;

use Syncitgroup\Sgform\Model\Formdata;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;


class Index extends Action
{

    protected $resultPageFactory;
    protected $_formdata;
    protected $resultFactory;
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
        Objectmanager $objectmanager
        
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_formdata = $formdata;
        $this->resultFactory = $resultFactory;
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
            
            $model = $this->objectManager->create(Formdata::class);

            $model->addData($formData);

            $saveData = $model->save();
            if($saveData){
                $this->messageManager->addSuccess( __('Thank you for submitting to Syncit Group custom form!') );
            }
        }
        return $this->resultPageFactory->create();
    }

}
