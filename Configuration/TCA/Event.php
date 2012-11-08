<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_nboevents_domain_model_event'] = array(
	'ctrl' => $TCA['tx_nboevents_domain_model_event']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, eventnr, date, course, maxreservations, reservationsleft, reservationdate, reservationnotes, reservationkey, reservationkeynotes, reservations',
	),
	'types' => array(
		'1' => array('showitem' => '
		--div--;LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event,
			eventnr, date,course,
		--div--;LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.settings,
				maxreservations;;1;;, reservationdate;;2;;, reservationkey;;3;;,
		--div--;LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation,
				reservations,
		--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access, hidden;;1, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'reservationsleft'),
		'2' => array('showitem' => 'reservationnotes'),
		'3' => array('showitem' => 'reservationkeynotes'),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_nboevents_domain_model_event',
				'foreign_table_where' => 'AND tx_nboevents_domain_model_event.pid=###CURRENT_PID### AND tx_nboevents_domain_model_event.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'eventnr' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.eventnr',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.description',
			'config' => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 7,
				'eval' => 'trim'
			),
		),
		'date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.date',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'maxreservations' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.maxreservations',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int',
				'default' => 15,
			),
		),
		'reservationsleft' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservationsleft',
			'config' => array(
				'type' => 'user',
				'size' => 4,
				'eval' => 'int',
				'userFunc' => 'EXT:nboevents/Classes/Domain/Model/Event.php:Tx_Nboevents_Domain_Model_Event->getRemaining',
			),
		),
		'reservationdate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservationdate',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'reservationnotes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservationnotes',
			'config' => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 10,
				'eval' => 'trim'
			),
		),
		'reservationkey' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservationkey',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'reservationkeynotes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservationkeynotes',
			'config' => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 10,
				'eval' => 'trim'
			),
		),
		'course' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.course',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_nboevents_domain_model_course',
				//'MM' => 'tx_nboevents_course_categories_mm',
				'size' => 1,
				'autoSizeMax' => 1,
				'maxitems' => 1,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_nboevents_domain_model_categories',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'reservations' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservations',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_nboevents_domain_model_reservation',
				'foreign_field' => 'event',
				// manually added
				'foreign_label' => 'person',
				'maxitems' => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
/*
 * 'images' => array(
  'exclude' => 0,
  'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.images',
  'config' => array(
  'type' => 'group',
  'internal_type' => 'file',
  'uploadfolder' => 'uploads/tx_nboevents',
  'show_thumbs' => 1,
  'minitems' => 3,
  'maxitems' => 10,
  'disable_controls' => 'upload',
  'size' => 5,
  'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
  'disallowed' => '',
  ),
  ),
 *
 */
?>