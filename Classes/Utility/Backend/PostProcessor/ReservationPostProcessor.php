<?php

class Tx_Nboevents_Utility_ReservationPostProcessor {
	function processDatamap_postProcessFieldArray($status, $table, $uid, &$fieldArray, &$reference) {
		if ($table == 'tx_nboevents_domain_model_reservation' && $status = 'update') {
			$row = t3lib_BEfunc::getRecord($table, $uid);
			if (is_array($row) && isset($fieldArray['status'])) {
				$fieldArray['pid'] = $fieldArray['status'];
			}
		}
	}
}

?>
