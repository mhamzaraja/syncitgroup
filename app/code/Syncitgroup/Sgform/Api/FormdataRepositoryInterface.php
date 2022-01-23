<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FormdataRepositoryInterface
{

    /**
     * Save formdata
     * @param \Syncitgroup\Sgform\Api\Data\FormdataInterface $formdata
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Syncitgroup\Sgform\Api\Data\FormdataInterface $formdata
    );

    /**
     * Retrieve formdata
     * @param string $formdataId
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($formdataId);

    /**
     * Retrieve formdata matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Syncitgroup\Sgform\Api\Data\FormdataSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete formdata
     * @param \Syncitgroup\Sgform\Api\Data\FormdataInterface $formdata
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Syncitgroup\Sgform\Api\Data\FormdataInterface $formdata
    );

    /**
     * Delete formdata by ID
     * @param string $formdataId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($formdataId);
}

