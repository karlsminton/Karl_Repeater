<?php

namespace Karl\Repeater\Api;


interface BlockRepositoryInterface
{

    public function getByIdentifier($identifier);
    
    public function save(\Karl\Repeater\Model\Block $block);
    
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria);
    
    public function delete(Data\BlockInterface $block);
    
    public function getCollectionProcessor();
}
