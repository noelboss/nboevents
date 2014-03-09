<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Courses',
	array(
		'Course' => 'list,show',
		'Reservation' => 'new, create',
	),
	// non-cacheable actions
	array(
		'Course' => 'list,show',
		'Reservation' => 'new, create',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Events',
	array(
		'Course' => 'events',
		'Event' => 'list, show',
		'Reservation' => 'list,show,billed,payed',
	),
	// non-cacheable actions
	array(
		'Course' => 'events',
		'Event' => 'list, show',
		'Reservation' => 'list,show,billed,payed',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Persons',
	array(
		'Reservation' => 'list,show,billed,payed',
		'Event' => 'list, show',
	),
	// non-cacheable actions
	array(
		'Reservation' => 'list,show,billed,payed',
		'Event' => 'list, show',
	)
);

$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['nboevents'] = 'EXT:nboevents/Classes/Utility/Backend/PostProcessor/ReservationPostProcessor.php:Tx_Nboevents_Utility_ReservationPostProcessor';

?>