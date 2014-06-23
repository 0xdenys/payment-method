<?php
/**
 * @author     Karazey Sergey <karazey.sergey@gmail.com>
 * @copyright  2014 Karazey Sergey
 * @created    6/23/14 9:49 PM
 */

$installer = $this;
$installer->startSetup();

$installer->getConnection()->addColumn(
    $this->getTable('sales/quote_payment'),
    'billing_code', // column name
    'VARCHAR(255) NOT NULL' // type definition
);

$installer->getConnection()->addColumn(
    $this->getTable('sales/quote_payment'),
    'billing_date',
    'VARCHAR(30) NOT NULL'
);

$installer->getConnection()->addColumn(
    $this->getTable('sales/order_payment'),
    'billing_code', // column name
    'VARCHAR(255) NOT NULL' // type definition
);

$installer->getConnection()->addColumn(
    $this->getTable('sales/order_payment'),
    'billing_date',
    'VARCHAR(30) NOT NULL'
);

$installer->endSetup();
