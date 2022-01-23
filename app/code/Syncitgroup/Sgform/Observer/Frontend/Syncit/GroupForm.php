<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Observer\Frontend\Syncit;
use Magento\Framework\ObjectManagerInterface as Objectmanager;
class GroupForm implements \Magento\Framework\Event\ObserverInterface
{


    protected $objectManager;
    public function __construct(Objectmanager $objectmanager) {
        $this->objectManager = $objectmanager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))  {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        try {
        $filesystem = $this->objectManager->get('Magento\Framework\Filesystem');
        $directoryList = $this->objectManager->get('Magento\Framework\App\Filesystem\DirectoryList');
        $media = $filesystem->getDirectoryWrite($directoryList::MEDIA);
        $contents = $observer->getData('email').": ".$ip_address;
        $media->writeFile("syncitgroup/userIP.txt",$contents);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}

