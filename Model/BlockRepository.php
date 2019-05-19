<?php

namespace Karl\Repeater\Model;

use Karl\Repeater\Api\BlockRepositoryInterface;
use Karl\Repeater\Api\Data\BlockInterface;
use Karl\Repeater\Model\ResourceModel\Block;
use Karl\Repeater\Model\BlockFactory;
use Karl\Repeater\Model\ResourceModel\Block\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class BlockRepository implements BlockRepositoryInterface
{

    protected $resource;

    protected $blockFactory;

    protected $blockCollectionFactory;

    public function __construct(
        CollectionFactory $blockCollectionFactory,
        Block $block,
        BlockFactory $blockFactory
    ) {
        $this->blockCollectionFactory = $blockCollectionFactory;
        $this->resource = $block;
        $this->blockFactory = $blockFactory;
    }

    public function getByIdentifier($identifier)
    {
        $block = $this->blockFactory->create();
        if ($identifier != null && $identifier != '') {
            try {
                $this->resource->load($block, $identifier, 'identifier');
            }
            catch (\Exception $e) {
                die($e->getMessage);
            }
        }
        return $block;
    }

    public function save(BlockInterface $block)
    {
        if ($block->getId() !== null) {
            try {
                $instance = $this->blockFactory->create();
                $this->resource->load($instance, $block->getId());
                $this->resource->save($instance->setData($block));
            } catch (\Exception $exception) {
                throw new CouldNotSaveException(__($exception->getMessage()));
            }
            return true;
        }
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $collection = $this->blockCollectionFactory->create();

        //$this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function delete(BlockInterface $block)
    {
        try {
            $this->resource->delete($block);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    private function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Karl\Repeater\Model\Api\SearchCriteria\BlockCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }
}
