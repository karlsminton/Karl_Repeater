<?php

namespace Karl\Repeater\Model;

use Karl\Repeater\Api\BlockRepositoryInterface;
use Karl\Repeater\Api\Data\BlockRepositoryInterfaceFactory;
use Karl\Repeater\Api\Data\BlockInterface;
use Karl\Repeater\Api\Data\BlockSearchResultsInterfaceFactory;
use Karl\Repeater\Model\ResourceModel\Block;
use Karl\Repeater\Model\BlockFactory;
use Karl\Repeater\Model\ResourceModel\Block\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class BlockRepository implements BlockRepositoryInterface
{

    protected $searchResultsFactory;

    protected $resource;

    protected $blockFactory;

    protected $blockCollectionFactory;

    public function __construct(
        BlockSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionFactory $blockCollectionFactory,
        Block $block,
        BlockFactory $blockFactory,
        \Karl\Repeater\Model\ResourceModel\Block $res
    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->blockCollectionFactory = $blockCollectionFactory;
        //$this->resource = $block;
        $this->resource = $res;
        $this->blockFactory = $blockFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }
    
    public function getById($id)
    {
        $block = $this->blockFactory->create();
        if ($id != null && $id != '') {
            try {
                $this->resource->load($block, $id, 'id');
            }
            catch (\Exception $e) {
                die($e->getMessage);
            }
        }
        return $block;
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

    public function save(\Karl\Repeater\Model\Block $block)
    {
        try {
            $this->resource->save($block);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $block;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $collection = $this->blockCollectionFactory->create();

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

    public function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Karl\Repeater\Model\Api\SearchCriteria\BlockCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }
}
