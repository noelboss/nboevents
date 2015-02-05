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
class Tx_Nboevents_Domain_Model_Event extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Reservation Key
	 *
	 * @var string
	 */
	protected $reservationkey;

	/**
	 * Reservation Key Notes
	 *
	 * @var string
	 */
	protected $reservationkeynotes;

	/**
	 * Eventnr
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $eventnr;

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * Date
	 *
	 * @var DateTime
	 */
	protected $date;

	/**
	 * Maximum Reservations
	 *
	 * @var integer
	 */
	protected $maxreservations;

	/**
	 * Remaining
	 *
	 * @var integer
	 */
	protected $remaining;

	/**
	 * Reservations possible until
	 *
	 * @var integer
	 */
	protected $reservationdate;

	/**
	 * Notes for Reservations
	 *
	 * @var string
	 */
	protected $reservationnotes;

	/**
	 * Reservations
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Reservation>
	 * @lazy
	 */
	protected $reservations;

	/**
	 * Course
	 *
	 * @var Tx_Nboevents_Domain_Model_Course
	 */
	protected $course;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->reservations = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the eventnr
	 *
	 * @return string $eventnr
	 */
	public function getEventnr() {
		return $this->eventnr;
	}

	/**
	 * Sets the eventnr
	 *
	 * @param string $eventnr
	 * @return void
	 */
	public function setEventnr($eventnr) {
		$this->eventnr = $eventnr;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the date
	 *
	 * @return DateTime $date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Sets the date
	 *
	 * @param integer $date
	 * @return void
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * Returns the maxreservations
	 *
	 * @return integer $maxreservations
	 */
	public function getMaxreservations() {
		return $this->maxreservations;
	}

	/**
	 * Returns the count of reservations
	 *
	 * @param integer $uid
	 * @return integer $remaining
	 */
	public function getCount($uid = 0) {
		$uid = $uid > 0 ? $uid : $this->getUid();
		$reservationRepository = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_ReservationRepository');
		return $reservationRepository->countByEvent($uid);
	}

	/**
	 * Set the remaining reservations
	 *
	 * @return void
	 */
	public function setRemaining() {
		$remaining = $this->getMaxreservations() - $this->getCount();
		if($remaining < 0){
			$remaining = 0;
		}
		$this->remaining = $remaining;
	}

	/**
	 * Returns the remaining reservations
	 *
	 * @return integer $remaining
	 */
	public function getRemaining() {
		$this->setRemaining();
		return $this->remaining;
	}

	/**
	 * Returns the remaining reservations
	 *
	 * @param array $params
	 * @return integer $remaining
	 */
	public function getTcaremaining($params = NULL) {
		$remaining = "Kann nicht berechnet werden.";
		if(is_array($params)){
			$uid = $params['row']['uid'];

			if($uid * 1 > 0){
				try {
					$eventRepository = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_EventRepository');
					$event = $eventRepository->findAllByUid($uid);

					$remaining = $event->getRemaining();

					$eventRepository->update($event);
					$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
					$persistenceManager->persistAll();

				} catch (Exception $e) {
					if(!$params['row']['reservations']){
						$remaining = $params['row']['maxreservations'];
					} else {
						$remaining = $params['row']['remaining'];
					}
				}
			} else {
				$remaining = $params['row']['maxreservations'];
			}

		}
		return $remaining;
	}

	/**
	 * Sets the maxreservations
	 *
	 * @param integer $maxreservations
	 * @return void
	 */
	public function setMaxreservations($maxreservations) {
		$this->maxreservations = $maxreservations;
		$this->setRemaining();
	}

	/**
	 * Returns the reservationdate
	 *
	 * @return DateTime $reservationdate
	 */
	public function getReservationdate() {
		return new DateTime(date('Y-m-d H:i:s', $this->reservationdate));
	}

	/**
	 * Returns if past event
	 *
	 * @return string $past
	 */
	public function getPast() {
		return date('U') > $this->getDate()->Format('U') ? 'past' : 'future';
	}

	/**
	 * Sets the reservationdate
	 *
	 * @param integer $reservationdate
	 * @return void
	 */
	public function setReservationdate($reservationdate) {
		$this->reservationdate = $reservationdate;
	}

	/**
	 * Check if Reservations Possible
	 *
	 * @return boolean
	 */
	public function getReservationsPossible() {
		if(($this->reservationdate > time()) && ($this->getRemaining() > 0)){
			$possible =  true;
		} else {
			$possible = false;
		}
		return $possible;
	}

	/**
	 * Event has Reservation
	 *
	 * @return boolean
	 */
	public function getHasReservation() {
		$result =  Tx_Nboevents_Utility_Cookies::getCookieValue('Reservation'.$this->getUid());
		$has = false;
		if($result > 0){
			$reservationRepository = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_ReservationRepository');

			if($reservationRepository->countByUid($result)){
				$has =  true;
			}
		}
		return $has;
	}

	/**
	 * Returns the Reservation Notes
	 *
	 * @return string $reservationnotes
	 */
	public function getReservationnotes() {
		return $this->reservationnotes;
	}

	/**
	 * Sets the Reservation Notes
	 *
	 * @param string $reservationnotes
	 * @return void
	 */
	public function setReservationnotes($reservationnotes) {
		$this->reservationnotes = $reservationnotes;
	}

	/**
	 * Returns the Reservation Key
	 *
	 * @return string $reservationkey
	 */
	public function getReservationkey() {
		return $this->reservationkey;
	}

	/**
	 * Sets the Reservation Key
	 *
	 * @param string $reservationkey
	 * @return void
	 */
	public function setReservationkey($reservationkey) {
		$this->reservationkey = $reservationkey;
	}

	/**
	 * Returns the Reservation Key Notes
	 *
	 * @return string $reservationkeynotes
	 */
	public function getReservationkeynotes() {
		return $this->reservationkeynotes;
	}

	/**
	 * Sets the Reservation Key Notes
	 *
	 * @param string $reservationkeynotes
	 * @return void
	 */
	public function setReservationkeynotes($reservationkeynotes) {
		$this->reservationkeynotes = $reservationkeynotes;
	}

	/**
	 * Adds a Reservation
	 *
	 * @param Tx_Nboevents_Domain_Model_Reservation $reservation
	 * @return void
	 */
	public function addReservation(Tx_Nboevents_Domain_Model_Reservation $reservation) {
		$this->reservations->attach($reservation);
	}

	/**
	 * Removes a Reservation
	 *
	 * @param Tx_Nboevents_Domain_Model_Reservation $reservationToRemove The Reservation to be removed
	 * @return void
	 */
	public function removeReservation(Tx_Nboevents_Domain_Model_Reservation $reservationToRemove) {
		$this->reservations->detach($reservationToRemove);
	}

	/**
	 * Returns the reservations
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Reservation> $reservations
	 */
	public function getReservations() {
		return $this->reservations;
	}

	/**
	 * Sets the reservations
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Reservation> $reservations
	 * @return void
	 */
	public function setReservations(Tx_Extbase_Persistence_ObjectStorage $reservations) {
		$this->reservations = $reservations;
	}

	/**
	 * Returns the course
	 *
	 * @return Tx_Nboevents_Domain_Model_Course $course
	 */
	public function getCourse() {
		return $this->course;
	}

	/**
	 * Sets the course
	 *
	 * @param Tx_Nboevents_Domain_Model_Course $course
	 * @return void
	 */
	public function setCourse(Tx_Nboevents_Domain_Model_Course $course) {
		$this->course = $course;
	}

	/**
	 * Returns the Label for TCA
	 *
	 * @param array $params
	 * @return integer $remaining
	 */
	public function getLabel(&$return) {
		$uid = $return['row']['uid'];
		$repo = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_EventRepository');
		$event = $repo->findAllByUid($uid);
		if($event){
			$course = count($event->getCourse()) > 0 ? $event->getCourse()->getTitle() : 'Kein Kurs';
			$course = substr($course, 0, 15)."...";
			$label = $event->getEventnr().', '.strftime("%a %d.%m.%y %H:%M",$event->getDate()->getTimestamp()).', '.$course.', '.$event->getRemaining();
		}
		$return['title'] = $label;
	}

}
?>