<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Events',
	array(
		'Course' => 'list,show',
		'Event' => 'list, show, new, create, edit, update, delete',
		'Person' => 'list, show, new, create, edit, update, delete',
		'Location' => 'list, show, new, create, edit, update, delete',
		'Reservation' => 'list, show, new, create, edit, update, delete',
		'Categories' => 'list',
	),
	// non-cacheable actions
	array(
		'Course' => 'list,show',
		'Event' => 'list, show, create, update, delete',
		'Person' => 'create, update, delete',
		'Location' => 'create, update, delete',
		'Reservation' => 'create, update, delete',
		'Categories' => '',
		
	)
);

?>