<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Api\Data;

interface FormdataSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get formdata list.
     * @return \Syncitgroup\Sgform\Api\Data\FormdataInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Syncitgroup\Sgform\Api\Data\FormdataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

