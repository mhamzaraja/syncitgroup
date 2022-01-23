<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model;

use Syncitgroup\Sgform\Api\Data\FormdataInterface;
use Syncitgroup\Sgform\Api\Data\FormdataInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Formdata extends \Magento\Framework\Model\AbstractModel
{

    protected $formdataDataFactory;

    protected $_eventPrefix = 'syncitgroup_sgform_formdata';
    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param FormdataInterfaceFactory $formdataDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Syncitgroup\Sgform\Model\ResourceModel\Formdata $resource
     * @param \Syncitgroup\Sgform\Model\ResourceModel\Formdata\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        FormdataInterfaceFactory $formdataDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Syncitgroup\Sgform\Model\ResourceModel\Formdata $resource,
        \Syncitgroup\Sgform\Model\ResourceModel\Formdata\Collection $resourceCollection,
        array $data = []
    ) {
        $this->formdataDataFactory = $formdataDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve formdata model with formdata data
     * @return FormdataInterface
     */
    public function getDataModel()
    {
        $formdataData = $this->getData();
        
        $formdataDataObject = $this->formdataDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $formdataDataObject,
            $formdataData,
            FormdataInterface::class
        );
        
        return $formdataDataObject;
    }
}

