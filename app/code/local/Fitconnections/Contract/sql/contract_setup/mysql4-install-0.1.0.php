<?php
$installer = $this;

$installer->startSetup();

$installer->run(
	"CREATE TABLE " . $installer->getTable('contract/list')." (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`userid` int(11) NOT NULL,
	`pid` int(11) NOT NULL,
	`price` double NOT NULL,
	`duration` varchar(255) NOT NULL,
	`firstname` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`phone` varchar(255) NOT NULL,
	`address` text  NOT NULL,
	`town` varchar(200) NOT NULL,
	`zipcode` varchar(200) NOT NULL,
	`state` varchar(200) NOT NULL,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);

$installer->endSetup();