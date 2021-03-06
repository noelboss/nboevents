<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Noel Bossart <n.company@me.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 *
 *
 * @package nboevents
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Nboevents_Domain_Repository_ReservationRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * countByEvent
	 *
	 * @param $uid
	 * @return
	 */
	public function countByEvent($uid = "0") {
		
				$query = $this->createQuery();
				$query->getQuerySettings()->setReturnRawQueryResult(true);
				$now = time();
				$queryText = 'SELECT res.count
							FROM `tx_nboevents_domain_model_reservation` AS res WHERE res.event = \'' . $uid . '\'
							AND res.deleted=0
							AND res.t3ver_state<=0
							AND res.pid<>-1
							AND res.hidden=0
							AND res.starttime<=' . $now . '
							AND (res.endtime=0 OR res.endtime>' . $now . ')
							AND res.sys_language_uid IN (0,-1)
							LIMIT 999';
				$query->statement($queryText);
				$rows = $query->execute();
		
				$count = 0;
				foreach ($rows as $row) {
					$count = $count + $row['count'];
				}
				return $count;
	}

	/**
	 * getPersonUid
	 *
	 * @param $uid
	 * @return
	 */
	public function getPersonUid($uid = "0") {
		
				$query = $this->createQuery();
				$query->getQuerySettings()->setReturnRawQueryResult(true);
				$now = time();
				$queryText = 'SELECT res.person
							FROM `tx_nboevents_domain_model_reservation` AS res WHERE uid = \'' . $uid . '\'
							AND res.deleted=0
							AND res.t3ver_state<=0
							AND res.pid<>-1
							AND res.hidden=0
							AND res.starttime<=' . $now . '
							AND (res.endtime=0 OR res.endtime>' . $now . ')
							AND res.sys_language_uid IN (0,-1)
							LIMIT 1';
				$query->statement($queryText);
				$rows = $query->execute();
				foreach ($rows as $row) {
					return $row['person'];
				}
	}

	/**
	 * findLabel
	 *
	 * @param $uid
	 * @return
	 */
	public function findLabel($uid = "0") {
		
				$query = $this->createQuery();
				$query->getQuerySettings()->setReturnRawQueryResult(true);
				$now = time();
				$queryText = 'SELECT ps.firstname, ps.lastname, ev.title, res.count
							FROM `tx_nboevents_domain_model_reservation` AS res
							LEFT JOIN tx_nboevents_domain_model_event AS ev ON res.event = ev.uid
							LEFT JOIN tx_nboevents_domain_model_person AS ps ON res.person = ps.uid
							WHERE res.uid = \'' . $uid . '\'
							AND res.deleted=0
							AND res.t3ver_state<=0
							AND res.pid<>-1
							AND res.hidden=0
							AND res.starttime<=' . $now . '
							AND (res.endtime=0 OR res.endtime>' . $now . ')
							AND res.sys_language_uid IN (0,-1)
							LIMIT 1';
		
				$query->statement($queryText);
				$rows = $query->execute();
				$label = '';
		
				foreach ($rows as $row) {
					foreach ($row as $key => $value) {
						switch ($key) {
							case 'lastname':
								$label .= $row[$key] . ' – ';
								break;
							case 'count':
								$label .= '(' . $row[$key] . ')';
								break;
							default:
								$label .= $row[$key] . ' ';
								break;
						}
					}
				}
				return $label;
	}

}

?>