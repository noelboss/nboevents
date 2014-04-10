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
	 * findAll
	 *
	 * @param $course
	 * @return
	 */
	public function findAll($limit = 999) {
		try {
			$now = time();

			$query = $this->createQuery();
			$query->getQuerySettings()->setReturnRawQueryResult(false);
			$now = time();
			$queryText = 'SELECT *
				FROM `tx_nboevents_domain_model_reservation`
				WHERE deleted=0
				AND t3ver_state<=0
				AND pid<>-1
				AND sys_language_uid IN (0,-1)
				ORDER BY crdate DESC
				LIMIT '.$limit;

				/*
				AND starttime<=' . $now . '
				AND (endtime=0 OR endtime>' . $now . ')
				*/

			$query->statement($queryText);
			$rows = $query->execute();
			return $rows;
		} catch (Exception $e) {
			echo $e;
		}
	}

	/**
	 * countByEvent
	 *
	 * @param $uid
	 * @return
	 */
	public function countByUid($uid = "0") {
		$query = $this->createQuery();
		$query->getQuerySettings()->setReturnRawQueryResult(true);
		$now = time();
		$queryText = 'SELECT res.uid
			FROM `tx_nboevents_domain_model_reservation` AS res WHERE res.uid = \'' . $uid . '\'
			AND res.deleted=0
			AND res.t3ver_state<=0
			AND res.pid<>-1
			AND res.hidden=0
			AND res.starttime<=' . $now . '
			AND (res.endtime=0 OR res.endtime>' . $now . ')
			AND res.sys_language_uid IN (0,-1)
			LIMIT 999';

		$query->statement($queryText);
		$count = $query->execute();
		return count($count);
	}


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
		$queryText = 'SELECT person
			FROM `tx_nboevents_domain_model_reservation`
			WHERE uid = \'' . $uid . '\'
			AND deleted=0
			AND t3ver_state<=0
			AND pid<>-1
			AND hidden=0
			AND starttime<=' . $now . '
			AND (endtime=0 OR endtime>' . $now . ')
			AND sys_language_uid IN (0,-1)
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
		$queryText = 'SELECT ev.eventnr, res.uid, ps.lastname, ps.firstname, ps.address, ps.street, ps.city, ps.phone, res.count
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

		foreach ($rows as $r) {
			if($r['address']){
				$address = $r['address'];
			} else {
				$address = $r['street'].', '.$r['city'];
			}
			$event = $r['eventnr'].'.'.$r['uid'];
			$name = $r['lastname'].', '.$r['firstname'];
			$phone = $r['phone'];
			$count = $r['count'];

			$label = $event.' – '.$name.' – '.$address.' – '.$phone.' ('.$count.')';
		}
		return $label;
	}

}

?>