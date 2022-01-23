<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model\ResourceModel\Formdata;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'formdata_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Syncitgroup\Sgform\Model\Formdata::class,
            \Syncitgroup\Sgform\Model\ResourceModel\Formdata::class
        );
    }
}

