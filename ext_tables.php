<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Events',
	'Events'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Events');

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_course', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_course.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_course');
$TCA['tx_nboevents_domain_model_course'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course',
		'label' => 'title',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Course.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_course.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_categories', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_categories.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_categories');
$TCA['tx_nboevents_domain_model_categories'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_categories',
		'label' => 'title',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Categories.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_categories.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_event', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_event.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_event');
$TCA['tx_nboevents_domain_model_event'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event',
		'label' => 'title',
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
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_event.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_person', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_person.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_person');
$TCA['tx_nboevents_domain_model_person'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_person',
		'label' => 'lastname',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Person.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_person.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_location', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_location.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_location');
$TCA['tx_nboevents_domain_model_location'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_location',
		'label' => 'title',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Location.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_location.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_reservation', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_reservation.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_reservation');
$TCA['tx_nboevents_domain_model_reservation'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation',
		'label' => 'count',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Reservation.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_reservation.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_course', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_course.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_course');
$TCA['tx_nboevents_domain_model_course'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course',
		'label' => 'title',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Course.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_course.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_categories', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_categories.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_categories');
$TCA['tx_nboevents_domain_model_categories'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_categories',
		'label' => 'title',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Categories.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_categories.gif'
	),
);

?>