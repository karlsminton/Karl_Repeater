<?php

namespace Karl\Repeater\Model;

use Magento\Framework\Model\AbstractModel;
use Karl\Repeater\Api\Data\BlockInterface;

class Block extends AbstractModel implements BlockInterface
{

    protected function _construct()
    {
        $this->_init(\Karl\Repeater\Model\ResourceModel\Block::class);
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

    public function getIdentifier()
    {
        return $this->getData('identifier');
    }

    public function setIdentifier($param)
    {
        return $this->setData('identifier', $param);
    }

    public function getItems()
    {
        return $this->getData('items');
    }

    public function setItems($param)
    {
        return $this->setData('items', $param);
    }
}
