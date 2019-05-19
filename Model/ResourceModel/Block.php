<?php

namespace Karl\Repeater\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Block extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('cms_repeater', 'id');
    }
}
