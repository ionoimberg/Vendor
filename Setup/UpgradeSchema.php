<?php

namespace Mageplaza\Vendor\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$installer->tableExists('mageplaza_vendor_vendor')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('mageplaza_vendor_vendor')
                )
                    ->addColumn(
                        'vendor_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Name'
                    )
                    ->addColumn(
                        'status',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        1,
                        [],
                        'Status'
                    )
                    ->addColumn(
                        'email',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Email'
                    )
                    ->addColumn(
                        'action',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Action'
                    )
                    ->setComment('Vendor Table');
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable('mageplaza_vendor_vendor'),
                    $setup->getIdxName(
                        $installer->getTable('mageplaza_vendor_vendor'),
                        ['name','email'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['name','email'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
        }

        if (version_compare($context->getVersion(), '1.2.0', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'telephone',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Telephone',
                    'after' => 'email'
                ]
            );
        }

        if (version_compare($context->getVersion(), '1.2.1', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'currency',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Currency',
                    'after' => 'telephone'
                ]
            );
        }

        if (version_compare($context->getVersion(), '1.2.2', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'notifications',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Notifications',
                    'after' => 'currency'
                ]
            );
        }

        if (version_compare($context->getVersion(), '1.2.3', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'specifications',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Specifications',
                    'after' => 'notifications'
                ]
            );
        }

        $installer->endSetup();
    }
}
