<?php

namespace Karl\Repeater\Model;

use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(\Karl\Repeater\Model\AbstractModel\Item::class);
    }

    public function getId()
    {
        return $this->getData('id');
    }

    public function setId($param)
    {
        return $this->setData('id', $param);
    }

    public function getName()
    {
        return $this->getData('name');
    }

    public function setName($param)
    {
        return $this->setData('name', $param);
    }

    public function getContent()
    {
        return $this->getData('name');
    }

    public function setContent($param)
    {
        return $this->setData('name', $param);
    }
}
