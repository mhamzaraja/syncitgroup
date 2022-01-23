<?php
declare(strict_types=1);

namespace Syncitgroup\Sgform\Model\ResourceModel;

class Formdata extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('syncitgroup_sgform_formdata', 'formdata_id');
    }
}