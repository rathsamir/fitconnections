<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('events/events_image'))
    ->addColumn('image_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        ), 'Value ID')
    ->addColumn('events_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        ), 'Events ID')
    ->addColumn('file', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Path')
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        ), 'Position')
    ->addColumn('disabled', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
        ), 'Is Disabled')
    ->addColumn('creation_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Media Creation Time')
    ->addColumn('update_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Media Modification Time')
    ->addForeignKey($installer->getFkName('events/events_image', 'events_id', 'events/events', 'events_id'), 'events_id', $installer->getTable('events/events'), 'events_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Events media');

$installer->getConnection()->createTable($table);

$installer->endSetup();
