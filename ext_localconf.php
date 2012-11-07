<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Events',
	array(
		'Course' => 'list,show',
		'Event' => 'list, show',
		'Location' => 'list, show,',
		'Reservation' => 'list, show, new, create',
		'Categories' => 'list',
	),
	// non-cacheable actions
	array(
		'Course' => 'list,show',
		'Event' => 'list, show',
		'Person' => 'create, update, delete',
		'Location' => 'create, update, delete',
		'Reservation' => '',
		'Categories' => 'list',
	)
);

?>