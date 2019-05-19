<?php

namespace Karl\Repeater\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $repeater = $setup->getConnection()->newTable(
            $setup->getTable('cms_repeater')
        )->addColumn(
            'id',
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            32,
            ['nullable' => false],
            'Block Name'
        )->addColumn(
            'identifier',
            Table::TYPE_TEXT,
            32,
            ['nullable' => false],
            'Model Identifier'
        )->addColumn(
            'items',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Assigned Items'
        );
        $setup->getConnection()->createTable($repeater);

        $items = $setup->getConnection()->newTable(
            $setup->getTable('cms_repeater_item')
        )->addColumn(
            'id',
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            32,
            ['nullable' => false],
            'Block Name'
        )->addColumn(
            'content',
            Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Content'
        );
        $setup->getConnection()->createTable($items);

        $setup->endSetup();
    }
}
