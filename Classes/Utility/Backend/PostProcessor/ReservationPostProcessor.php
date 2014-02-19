<?php

class Tx_Nboevents_Utility_ReservationPostProcessor {
	function processDatamap_postProcessFieldArray($orderstatus, $table, $uid, &$fieldArray, &$reference) {

		/*var_dump($orderstatus);
		var_dump($table);
		var_dump($fieldArray);*/

		if ($table == 'tx_nboevents_domain_model_reservation' && $orderstatus == 'update') {
			$row = t3lib_BEfunc::getRecord($table, $uid);
			if (is_array($row) && isset($fieldArray['orderstatus'])) {
				$fieldArray['pid'] = $fieldArray['orderstatus'];
			}
		} else if ($table == 'tx_nboevents_domain_model_reservation' && $orderstatus == 'new') {
			$fieldArray['pid'] = $fieldArray['orderstatus'];
		}

		if ($table == 'tx_nboevents_domain_model_event' && $orderstatus == 'update') {
			$row = t3lib_BEfunc::getRecord($table, $uid);
			if (is_array($row) && isset($fieldArray['orderstatus'])) {
				var_dump($row);
			}
		} else if ($table == 'tx_nboevents_domain_model_event' && $orderstatus == 'new') {

		}
	}
}

?>
