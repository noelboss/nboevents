<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_nboevents_domain_model_course'] = array(
	'ctrl' => $TCA['tx_nboevents_domain_model_course']['ctrl'],
	'interface' => array(
		'maxDBListItems' => 99,
		'showRecordFieldList' => 'hidden, title, type, description, price, events, categories, images',
	),
	'types' => array(
		'1' => array('showitem' => 'events, title, type, description, price, images, --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access, hidden, starttime, endtime'),
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
				'foreign_table' => 'tx_nboevents_domain_model_course',
				'foreign_table_where' => 'AND tx_nboevents_domain_model_course.pid=###CURRENT_PID### AND tx_nboevents_domain_model_course.sys_language_uid IN (-1,0)',
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
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course.type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5	,
				'eval' => 'trim,required',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext[]',
		),
		'price' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course.price',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course.images',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_nboevents',
				'minitems' => 0,
				'maxitems' => 10,
				'disable_controls' => 'upload',
				'size' => 5,
				'show_thumbs' => 1,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'events' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nboevents/Resources/Private/Language/locallang_db.xml:tx_nboevents_domain_model_course.events',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_nboevents_domain_model_event',
				'foreign_field' => 'course',
				'foreign_table_where' => 'ORDER BY tx_nboevents_domain_model_event.date DESC',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'expandSingle' => 1,
				),
			),
		),
	),
);

?>