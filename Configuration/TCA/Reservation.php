<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_nboevents_domain_model_reservation'] = array(
	'ctrl' => $TCA['tx_nboevents_domain_model_reservation']['ctrl'],
	'interface' => array(
		'maxDBListItems' => 10,
		'maxSingleDBListItems' => 10,
		'showRecordFieldList' => 'count, notes, person, event, pid, orderstatus',
	),
	'types' => array(
		'1' => array('showitem' => 'count, notes, person, event, --div--;LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.billing, orderstatus, billsent, payuntil, payed, notesbissfest'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
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
				'foreign_table' => 'tx_nboevents_domain_model_reservation',
				'foreign_table_where' => 'AND tx_nboevents_domain_model_reservation.pid=###CURRENT_PID### AND tx_nboevents_domain_model_reservation.sys_language_uid IN (-1,0)',
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
		'count' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.count',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required',
				'default' => '1',
			),
		),
		'notes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.notes',
			'config' => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 4,
				'eval' => 'trim'
			),
		),
		'orderstatus' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.orderstatus',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'pages',
				'suppress_icons' => 1,
				//'foreign_table_where' => 'AND tx_nboevents_domain_model_event.pid=###CURRENT_PID### AND tx_nboevents_domain_model_event.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND (pages.pid IN (35) OR pages.uid IN (35)) AND (pages.hidden = 0 AND pages.deleted = 0 AND pages.doktype = 254)',
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'notesbissfest' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.notesbissfest',
			'config' => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 4,
				'eval' => 'trim'
			),
		),
		'billsent' => array(
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.billsent',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'date',
				'default' => 0,
				/*'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),*/
			),
		),
		'payuntil' => array(
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.payuntil',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'date',
				'default' => 0,
				/*'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),*/
			),
		),
		'payed' => array(
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.payed',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'date',
				'default' => 0,
				/*'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),*/
			),
		),
		'person' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.person',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_nboevents_domain_model_person',
				//'foreign_table_where' => 'AND tx_nboevents_domain_model_person.pid=###CURRENT_PID### AND tx_nboevents_domain_model_person.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_nboevents_domain_model_person.sys_language_uid IN (-1,0) ORDER BY lastname,firstname',
				'minitems' => 1,
				'maxitems' => 1,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 0,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,orderstatus=0,menubar=0,scrollbars=1',
					),
					'suggest' => array(
						'type' => 'suggest',
					),
					/*'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_nboevents_domain_model_person',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),*/
				),
			),
		),
		'event' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_reservation.event',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_nboevents_domain_model_event',
				//'foreign_table_where' => 'AND tx_nboevents_domain_model_event.pid=###CURRENT_PID### AND tx_nboevents_domain_model_event.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_nboevents_domain_model_event.sys_language_uid IN (-1,0) ORDER BY tx_nboevents_domain_model_event.date, tx_nboevents_domain_model_event.eventnr DESC',
				'minitems' => 1,
				'maxitems' => 1,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 0,
					'suggest' => array(
						'type' => 'suggest',
					),
					/*'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,orderstatus=0,menubar=0,scrollbars=1',
					),*/
					/*'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_nboevents_domain_model_event',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),*/
				),
			),
		),
		'tstamp' => Array (
			'exclude' => 1,
			'label' => 'Creation date',
			'config' => Array (
				'type' => 'none',
				'format' => 'date',
				'eval' => 'date',
			)
		),
		'pid' => Array (
			'exclude' => 1,
			'label' => 'Orderstatus',
			'config' => Array (
				'type' => 'none',
				'eval' => 'int',
			)
		),
	),
);


## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
// 'MM_opposite_field' => 'reservations',
?>