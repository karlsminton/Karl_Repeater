<?php

namespace Karl\Repeater\Api\Data;

use Karl\Repeater\Model\BlockRepository;

class BlockRepositoryInterfaceFactory
{
  
    private $objectManager;
    
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->objectManager = $objectManager;
    }
    
    public function create(array $data = [])
    {
        return $this->objectManager->create(BlockRepository::class, $data);
    }
}