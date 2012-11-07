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
class Tx_Nboevents_Domain_Model_Person extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Lastname
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $lastname;

	/**
	 * Firstname
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $firstname;

	/**
	 * email
	 *
	 * @var string
	 * @validate EmailAddress
	 */
	protected $email;

	/**
	 * Phone
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $phone;

	/**
	 * Address
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $address;

	/**
	 * Reservation for Events
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Reservation>
	 * @lazy
	 */
	protected $reservations;

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
	 * Returns the lastname
	 *
	 * @return string $lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * Sets the lastname
	 *
	 * @param string $lastname
	 * @return void
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * Returns the firstname
	 *
	 * @return string $firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Returns the Label for TCA
	 *
	 * @param array $params
	 * @return integer $remaining
	 */
	public function getLabel(&$return) {
		$uid = $return['row']['uid'];
		$repo = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_PersonRepository');
		$person = $repo->findByUid($uid);
		$label = 'hello';
		if($person){
			$label = $person->getFirstname().' '.$person->getLastname();
		}
		$return['title'] = $label;
	}

	/**
	 * Sets the firstname
	 *
	 * @param string $firstname
	 * @return void
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the phone
	 *
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
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

}

?>