<?php

/***************************************************************
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
 ***************************************************************/

/**
 *
 *
 * @package nboevents
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Nboevents_Domain_Repository_EventRepository extends Tx_Extbase_Persistence_Repository {
	/**
	 * defaultOrderings
	 *
	 * @var array
	 */
	protected $defaultOrderings = array(
		'date' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
	);


	/**
	 * findAll
	 *
	 * @param $limit
	 * @return
	 */
	public function findAll($limit = 999) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(false);
		return $query->setOrderings(array('eventnr' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING))
			->setLimit((integer)$limit)
			->execute();
	}

	/**
	 * findAll
	 *
	 * @param $limit
	 * @return
	 */
	public function findAllHidden($limit = 999) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(false);
		$query->getQuerySettings()->setRespectEnableFields(false);

		return $query->setOrderings(array('eventnr' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING))
			->setLimit((integer)$limit)
			->matching(
				$query->logicalAnd(
					$query->equals('deleted', 0)
				)
			)
			->execute();
	}

	/**
	 * findByCourse
	 *
	 * @param $uid
	 * @return
	 */
	public function findByCourse($course = 0, $limit = 99) {
		$now = time();
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(false);
		$query->matching(
			$query->logicalAnd(
				$query->equals('course', $course),
				$query->greaterThanOrEqual('date', $now)
			)
		);
		$query->setLimit((integer)$limit);
		$events = $query->execute();
		return $events;
	}

	/**
	 * findAllByCourse
	 *
	 * @param $course
	 * @return
	 */
	public function findAllByCourse($course = 0, $limit = 99) {
		$now = time();

		$query = $this->createQuery();
		$query->getQuerySettings()->setReturnRawQueryResult(false);
		$now = time();
		$queryText = 'SELECT *
			FROM `tx_nboevents_domain_model_event`
			WHERE course = \'' . $course . '\'
			AND deleted=0
			AND date >=' . $now . '
			LIMIT '.$limit;

			/*
			AND starttime<=' . $now . '
			AND (endtime=0 OR endtime>' . $now . ')
			*/

		$query->statement($queryText);
		$rows = $query->execute();
		return $rows;
	}


	/**
	 * findAllByUid
	 *
	 * @param $course
	 * @return
	 */
	public function findAllByUid($uid = 0, $limit = 1) {
		$query = $this->createQuery();
		$queryText = 'SELECT *
			FROM `tx_nboevents_domain_model_event`
			WHERE uid = \'' . $uid . '\'
			AND deleted=0
			LIMIT '.$limit;

		$query->statement($queryText);
		$rows = $query->execute();
		foreach ($rows as $row) {
			return $row;
		}
	}

	/**
	 * findAllByReservation
	 *
	 * @param $reservation
	 * @return
	 */
	public function findAllByReservation($uid) {

		$query = $this->createQuery();
		$queryText = 'SELECT ev.*
			FROM `tx_nboevents_domain_model_event` AS ev
			LEFT JOIN tx_nboevents_domain_model_reservation AS res ON res.event = ev.uid
			WHERE res.uid = \'' . $uid . '\'
			AND ev.deleted=0
			LIMIT 1';

		$query->statement($queryText);
		$rows = $query->execute();
		foreach ($rows as $row) {
			return $row;
		}
	}
}
?>