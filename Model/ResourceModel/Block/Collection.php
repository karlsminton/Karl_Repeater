<?php

namespace Karl\Repeater\Model\ResourceModel\Block;

use Karl\Repeater\Api\Data\BlockInterface;
use Karl\Repeater\Model\ResourceModel\Block\AbstractCollection;

/**
 * CMS Block Collection
 */
class Collection extends AbstractCollection
{

    protected $_idFieldName = 'id';

    protected $_eventPrefix = 'repeater_collection';

    protected $_eventObject = 'repeater_collection';

    protected function _construct()
    {
        $this->_init(\Karl\Repeater\Model\Block::class, \Karl\Repeater\Model\ResourceModel\Block::class);
        $this->_map['fields']['id'] = 'main_table.id';
    }

    public function toOptionArray()
    {
        return $this->_toOptionArray('id', 'name');
    }

    public function addStoreFilter($store, $withAdmin = true)
    {
        $this->performAddStoreFilter($store, $withAdmin);
        return $this;
    }

    protected function _renderFiltersBefore()
    {
        $entityMetadata = $this->metadataPool->getMetadata(BlockInterface::class);
        $this->joinStoreRelationTable('cms_repeater', $entityMetadata->getLinkField());
    }
}
