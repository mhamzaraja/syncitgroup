<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model;

use Syncitgroup\Sgform\Api\Data\FormdataInterfaceFactory;
use Syncitgroup\Sgform\Api\Data\FormdataSearchResultsInterfaceFactory;
use Syncitgroup\Sgform\Api\FormdataRepositoryInterface;
use Syncitgroup\Sgform\Model\ResourceModel\Formdata as ResourceFormdata;
use Syncitgroup\Sgform\Model\ResourceModel\Formdata\CollectionFactory as FormdataCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class FormdataRepository implements FormdataRepositoryInterface
{

    protected $formdataFactory;

    protected $formdataCollectionFactory;

    protected $dataObjectProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    private $storeManager;

    protected $dataFormdataFactory;

    protected $resource;

    protected $dataObjectHelper;

    protected $extensionAttributesJoinProcessor;


    /**
     * @param ResourceFormdata $resource
     * @param FormdataFactory $formdataFactory
     * @param FormdataInterfaceFactory $dataFormdataFactory
     * @param FormdataCollectionFactory $formdataCollectionFactory
     * @param FormdataSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceFormdata $resource,
        FormdataFactory $formdataFactory,
        FormdataInterfaceFactory $dataFormdataFactory,
        FormdataCollectionFactory $formdataCollectionFactory,
        FormdataSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->formdataFactory = $formdataFactory;
        $this->formdataCollectionFactory = $formdataCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataFormdataFactory = $dataFormdataFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Syncitgroup\Sgform\Api\Data\FormdataInterface $formdata
    ) {
        $formdataData = $this->extensibleDataObjectConverter->toNestedArray(
            $formdata,
            [],
            \Syncitgroup\Sgform\Api\Data\FormdataInterface::class
        );
        
        $formdataModel = $this->formdataFactory->create()->setData($formdataData);
        
        try {
            $this->resource->save($formdataModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the formdata: %1',
                $exception->getMessage()
            ));
        }
        return $formdataModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($formdataId)
    {
        $formdata = $this->formdataFactory->create();
        $this->resource->load($formdata, $formdataId);
        if (!$formdata->getId()) {
            throw new NoSuchEntityException(__('formdata with id "%1" does not exist.', $formdataId));
        }
        return $formdata->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->formdataCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Syncitgroup\Sgform\Api\Data\FormdataInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Syncitgroup\Sgform\Api\Data\FormdataInterface $formdata
    ) {
        try {
            $formdataModel = $this->formdataFactory->create();
            $this->resource->load($formdataModel, $formdata->getFormdataId());
            $this->resource->delete($formdataModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the formdata: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($formdataId)
    {
        return $this->delete($this->get($formdataId));
    }
}

