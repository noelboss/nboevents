<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_nboevents_domain_model_event'] = array(
	'ctrl' => $TCA['tx_nboevents_domain_model_event']['ctrl'],
	'interface' => array(
		'maxDBListItems' => 999,
		'maxSingleDBListItems' => 999,
		'showRecordFieldList' => 'hidden, eventnr, date, course, description, maxreservations, tcaremaining, remaining, reservationdate, reservations',
	),
	'types' => array(
		'1' => array('showitem' => '
		--div--;LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation,
				tcaremaining, reservations,
		--div--;LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.tab,
			eventnr, course, description, date, reservationdate, maxreservations, reservationnotes,
		--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access, hidden;;1, starttime, endtime'),
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
				'size' => 4,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
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
		'remaining' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservationsleft',
			'config' => array(
				'type' => 'user',
				'size' => 4,
				'readOnly' =>1,
				'eval' => 'int',
			),
		),
		'tcaremaining' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.reservationsleft',
			'config' => array(
				'type' => 'user',
				'size' => 4,
				'readOnly' =>1,
				'eval' => 'int',
				'userFunc' => 'EXT:nboevents/Classes/Domain/Model/Event.php:Tx_Nboevents_Domain_Model_Event->getTcaremaining',
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
				'cols' => 40,
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
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim',
			),
		),
		'course' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_event.course',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_nboevents_domain_model_course',
				'foreign_table_where' => ' ORDER BY title',
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
						'JSopenParams' => 'height=350,width=580,orderstatus=0,menubar=0,scrollbars=1',
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
					'collapse' => 1,
					'levelLinksPosition' => 'bottom',
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