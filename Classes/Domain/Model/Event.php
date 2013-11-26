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
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * date
	 *
	 * @var integer
	 */
	protected $date;

	/**
	 * Maximum Reservations
	 *
	 * @var integer
	 */
	protected $maxreservations;

	/**
	 * Maximum Reservations per Person
	 *
	 * @var integer
	 */
	protected $maxreservationsperperson;

	/**
	 * Reservations until date
	 *
	 * @var integer
	 */
	protected $reservationdate;

	/**
	 * Reservation Notes
	 *
	 * @var string
	 */
	protected $reservationnotes;

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
	 * Images
	 *
	 * @var string
	 */
	protected $images;

	/**
	 * Reservations
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Reservation>
	 */
	protected $reservations;

	/**
	 * Locations
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Location>
	 */
	protected $locations;

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
		$this->locations = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
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
		return new DateTime(date('Y-m-d H:i:s', $this->date));
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
	 * Sets the maxreservations
	 *
	 * @param integer $maxreservations
	 * @return void
	 */
	public function setMaxreservations($maxreservations) {
		$this->maxreservations = $maxreservations;
	}

	/**
	 * Returns the maxreservationsperperson
	 *
	 * @return integer $maxreservationsperperson
	 */
	public function getMaxreservationsperperson() {
		return $this->maxreservationsperperson < 1 ? 999 : $this->maxreservationsperperson;
	}

	/**
	 * Sets the maxreservationsperperson
	 *
	 * @param integer $maxreservationsperperson
	 * @return void
	 */
	public function setMaxreservationsperperson($maxreservationsperperson) {
		$this->maxreservationsperperson = $maxreservationsperperson;
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
	 * Returns the remaining reservations
	 *
	 * @param array $params
	 * @return integer $remaining
	 */
	public function getRemaining($params = NULL) {
		$remaining = 0;
		if($params){
			$remaining = ($params['row']['maxreservations'] - $this->getCount($params['row']['uid']));
		}else {
			$remaining = ($this->getMaxreservations() - $this->getCount());
		}
		if($remaining < 0){
			$remaining = 0;
		}
		return $remaining;
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
	 * Returns the images
	 *
	 * @return string $images
	 */
	public function getImages() {
		return explode(',', $this->images);
	}

	/**
	 * Sets the images
	 *
	 * @param string $images
	 * @return void
	 */
	public function setImages($images) {
		$this->images = $images;
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
	 * Adds a Location
	 *
	 * @param Tx_Nboevents_Domain_Model_Location $location
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Location> locations
	 */
	public function addLocation(Tx_Nboevents_Domain_Model_Location $location) {
		$this->locations->attach($locations);
	}

	/**
	 * Removes a Location
	 *
	 * @param Tx_Nboevents_Domain_Model_Location $locationToRemove The Location to be removed
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Location> locations
	 */
	public function removeLocation(Tx_Nboevents_Domain_Model_Location $locationToRemove) {
		$this->locations->detach($locationToRemove);
	}

	/**
	 * Returns the locations
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Location> locations
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * Sets the locations
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Location> $locations
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Location> locations
	 */
	public function setLocations(Tx_Extbase_Persistence_ObjectStorage $locations) {
		$this->locations = $locations;
	}

}
?>