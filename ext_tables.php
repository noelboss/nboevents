<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
		$_EXTKEY, 'Events', 'Events'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Events');

t3lib_extMgm::addLLrefForTCAdescr('tx_sjevents_domain_model_event', 'EXT:sjevents/Resources/Private/Language/locallang_csh_tx_sjevents_domain_model_event.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_sjevents_domain_model_event');
$TCA['tx_sjevents_domain_model_event'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:sjevents/Resources/Private/Language/locallang_db.xml:tx_sjevents_domain_model_event',
		'label' => 'title',
		'label_alt' => 'date',
		'label_alt_force' => TRUE,
		'thumbnail' => 'images',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Event.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sjevents_domain_model_event.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_sjevents_domain_model_person', 'EXT:sjevents/Resources/Private/Language/locallang_csh_tx_sjevents_domain_model_person.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_sjevents_domain_model_person');
$TCA['tx_sjevents_domain_model_person'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:sjevents/Resources/Private/Language/locallang_db.xml:tx_sjevents_domain_model_person',
		'label'     => 'firstname',
		'label_userFunc' => 'EXT:sjevents/Classes/Domain/Model/Person.php:Tx_Sjevents_Domain_Model_Person->getLabel',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		/*'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),*/
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Person.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sjevents_domain_model_person.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_sjevents_domain_model_location', 'EXT:sjevents/Resources/Private/Language/locallang_csh_tx_sjevents_domain_model_location.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_sjevents_domain_model_location');
$TCA['tx_sjevents_domain_model_location'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:sjevents/Resources/Private/Language/locallang_db.xml:tx_sjevents_domain_model_location',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'label_alt' => 'title,address',
		'label_alt_force' => TRUE,
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Location.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sjevents_domain_model_location.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_sjevents_domain_model_reservation', 'EXT:sjevents/Resources/Private/Language/locallang_csh_tx_sjevents_domain_model_reservation.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_sjevents_domain_model_reservation');
$TCA['tx_sjevents_domain_model_reservation'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:sjevents/Resources/Private/Language/locallang_db.xml:tx_sjevents_domain_model_reservation',

		'label' => 'Reservation',
		'label_userFunc' => 'EXT:sjevents/Classes/Domain/Model/Reservation.php:Tx_Sjevents_Domain_Model_Reservation->getLabel',

		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		/*'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),*/
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Reservation.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_sjevents_domain_model_reservation.gif'
	),
);
?>