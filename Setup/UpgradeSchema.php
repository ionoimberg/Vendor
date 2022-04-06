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

        if (version_compare($context->getVersion(), '1.2.4', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'contact_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Contact Name',
                    'after' => 'action'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'street',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Street',
                    'after' => 'contact_name'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'city',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'City',
                    'after' => 'street'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'postal_code',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Postal Code',
                    'after' => 'city'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'country',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Country',
                    'after' => 'postal_code'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'state_region',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'State/Region',
                    'after' => 'country'
                ]
            );
        }

        if (version_compare($context->getVersion(), '1.2.5', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'shipp_contact_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Shipping Contact Name',
                    'after' => 'country'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'shipp_street',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Shipping Street',
                    'after' => 'shipp_contact_name'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'shipp_city',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Shipping City',
                    'after' => 'shipp_street'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'shipp_postal_code',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Shipping Postal Code',
                    'after' => 'shipp_city'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'shipp_country',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Shipping Country',
                    'after' => 'shipp_postal_code'
                ]
            );
            $installer->getConnection()->addColumn(
                $installer->getTable('mageplaza_vendor_vendor'),
                'shipp_state_region',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Shipping State/Region',
                    'after' => 'shipp_country'
                ]
            );
        }

        $installer->endSetup();
    }
}
