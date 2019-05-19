<?php

namespace Karl\Repeater\Block;

use Magento\Framework\View\Element\Template;
use Karl\Repeater\Model\BlockRepository;

class Block extends Template
{

    public $block;

    protected $repository;

    public function __construct(
        BlockRepository $repository,
        Template\Context $context,
        $data = []
    ) {
        $this->repository = $repository;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        if ($identifier = $this->getData('identifier')) {
            $this->block = $this->repository->getByIdentifer($identifier);
        }
    }
}
