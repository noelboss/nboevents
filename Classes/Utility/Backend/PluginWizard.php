<?php

/**
 * Adds the Plugin Wizard to the Backend
 *
 * @author Noël Bossart
 */
class Tx_Nboevents_Utilities_PluginWizard {

	/**
	 * Adds the wizard icon
	 *
	 * @param	array		Input array with wizard items for plugins
	 * @return	array		Modified input array, having the item for the plugin added.
	 */
	function proc($wizardItems)	{
		$wizardItems['plugins_tx_nboevents_display'] = array(
			'icon'=>t3lib_extMgm::extRelPath('nboevents').'Resources/Public/Icons/be_wizard.gif',
			'title'=>Tx_Extbase_Utility_Localization::translate("backend.wizard", "nboevents", NULL),
			'description'=>Tx_Extbase_Utility_Localization::translate("backend.wizard.description", "nboevents", NULL),
			'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=nboevents_events'
		);  
		return $wizardItems;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/nboevents/Classes/Utilities/Backend/wizicon.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/nboevents/Classes/Utilities/Backend/wizicon.php']);
}
?>