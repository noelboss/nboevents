<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Events',
	array(
		'Event' => 'list, show, new, create, edit, update, delete',
		'Person' => 'list, show, new, create, edit, update, delete',
		'Location' => 'list, show, new, create, edit, update, delete',
		'Reservation' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	// Update und delete entfernen?
	array(
		'Event' => 'create, update, delete',
		'Person' => 'create, update, delete',
		'Location' => 'create, update, delete',
		'Reservation' => 'new, create, edit, update, delete',
	)
);

?>