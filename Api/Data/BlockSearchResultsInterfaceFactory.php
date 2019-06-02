<?php

namespace Karl\Repeater\Api\Data;

use Karl\Repeater\Api\Data\BlockSearchResultsInterface;

class BlockSearchResultsInterfaceFactory
{
  
    private $objectManager;
    
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->objectManager = $objectManager;
    }
    
    public function create(array $data = [])
    {
        return $this->objectManager->create(BlockSearchResultsInterface::class, $data);
    }
}