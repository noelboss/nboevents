<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Courses',
	'Kurse: Liste der Kurse & Reisen'
);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Events',
	'Kurse: Liste der Anlässe'
);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Persons',
	'Kurse: Personen und Rechnungen'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Events');


t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_course', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_course.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_course');
$TCA['tx_nboevents_domain_model_course'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course',
		'label' => 'title',
		'sortby' => 'sorting',
		'default_sortby' => 'ORDER BY title',
		'searchFields' => 'title,description,price',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 0,
		//'thumbnail' => 'images',
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

/*t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_categories', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_categories.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_categories');
$TCA['tx_nboevents_domain_model_categories'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_categories',
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
);$*/

t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_event', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_event.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_event');
$TCA['tx_nboevents_domain_model_event'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event',
		'label' => 'eventnr',
		'sortby' => 'date ASC',
		'searchFields' => 'date,course,eventnr',
		'label_alt' => 'date,course',
		'label_alt_force' => true,
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
		'title' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_person',
		'label'		=> 'lastname',
		'label_alt' => 'firstname,',
		'default_sortby' => 'ORDER BY lastname,firstname',
		'label_userFunc' => 'EXT:nboevents/Classes/Domain/Model/Person.php:Tx_Nboevents_Domain_Model_Person->getLabel',
		'searchFields' => 'lastname,firstname,address,phone,email',
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
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_person.gif'
	),
);
/*
t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_location', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_location.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_location');
$TCA['tx_nboevents_domain_model_location'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_location',
		'label' => 'title',
		'default_sortby' => 'ORDER BY title',
		'searchFields' => 'title,address',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'label_alt' => 'address',
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
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_location.gif'
	),
);
*/
t3lib_extMgm::addLLrefForTCAdescr('tx_nboevents_domain_model_reservation', 'EXT:nboevents/Resources/Private/Language/locallang_csh_tx_nboevents_domain_model_reservation.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nboevents_domain_model_reservation');
$TCA['tx_nboevents_domain_model_reservation'] = array(
	'ctrl' => array(
		/*'hideTable' => 1, /* don't display in backend-list */
		'title' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation',
		'label' => 'uid',
		'label_userFunc' => 'EXT:nboevents/Classes/Domain/Model/Reservation.php:Tx_Nboevents_Domain_Model_Reservation->getLabel',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'default_sortby' => 'ORDER BY crdate',
		'searchFields' => 'person,notesbissfest,notes,event,uid',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Reservation.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nboevents_domain_model_reservation.gif'
	),
);
if (TYPO3_MODE == 'BE') {
	// Add Wizard Icon
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['Tx_Nboevents_Utilities_PluginWizard'] = t3lib_extMgm::extPath($_EXTKEY).'Classes/Utility/Backend/PluginWizard.php';

	// Add tables on Pages:
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_event'][0]['fList'] = 'eventnr,date,course,maxreservations';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_event'][0]['icon'] = TRUE;

	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_course'][0]['fList'] = 'title,type,price';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_course'][0]['icon'] = TRUE;

	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_location'][0]['fList'] = 'title,address';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_location'][0]['icon'] = TRUE;

	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_reservation'][0]['fList'] = 'event,person;count,sent;payuntil;payed,notes;notesbissfest';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_reservation'][0]['icon'] = TRUE;

	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_person'][0]['fList'] = 'gender,lastname,firstname,address,email';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nboevents_domain_model_person'][0]['icon'] = TRUE;
}
?>