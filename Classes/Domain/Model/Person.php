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
	 * Gender
	 *
	 * @var integer
	 */
	protected $gender;

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
	 * Phonemobile
	 *
	 * @var string
	 */
	protected $phonemobile;

	/**
	 * Phonecompany
	 *
	 * @var string
	 */
	protected $phonecompany;

	/**
	 * Street
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $street;

	/**
	 * ZIP & City
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $city;

	/**
	 * Address
	 *
	 * @var string
	 */
	protected $address;

	/**
	 * Reservation for Events
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Reservation>
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
	 * Formats swiss phone numbers
	 *
	 * @return string
	 */
	protected function formatPhone($phone) {
		$phone = str_replace("+","00", $phone);
		$phone = str_replace("0041","", $phone);
		$phone = str_replace("/[^0-9]/","",$phone);
		return trim(substr($phone , 0, -7).' '.substr($phone , -7, 3).' '.substr($phone , -4, 2).' '.substr($phone , -2, 2));
	}



	/**
	 * Returns the gender
	 *
	 * @return integer $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param integer $gender
	 * @return void
	 */
	public function setGender($gender) {
		$this->gender = $gender;
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
		return $this->formatPhone($this->phone);
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
	 * Returns the phonemobile
	 *
	 * @return string $phonemobile
	 */
	public function getPhonemobile() {
		return $this->formatPhone($this->phonemobile);
	}

	/**
	 * Sets the phonemobile
	 *
	 * @param string $phonemobile
	 * @return void
	 */
	public function setPhonemobile($phonemobile) {
		$this->phonemobile = $phonemobile;
	}

	/**
	 * Returns the phonecompany
	 *
	 * @return string $phonecompany
	 */
	public function getPhonecompany() {
		return $this->formatPhone($this->phonecompany);
	}

	/**
	 * Sets the phonecompany
	 *
	 * @param string $phonecompany
	 * @return void
	 */
	public function setPhonecompany($phonecompany) {
		$this->phonecompany = $phonecompany;
	}

	/**
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		if($this->address){
			return $this->address;
		} else {
			return $this->street."\n".$this->city;
		}
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
	 * Returns the street
	 *
	 * @return string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
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
	 * Returns the Label for TCA
	 *
	 * @param array $params
	 * @return integer $remaining
	 */
	public function getLabel(&$return) {
		$uid = $return['row']['uid'];
		$repo = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_PersonRepository');
		$person = $repo->findByUid($uid);
		if($person){
			$address = $person->getStreet() && $person->getCity() ? $person->getCity().', '.$person->getStreet() : $person->getAddress();
			$label = $person->getLastname().' '.$person->getFirstname().' – '.$address.' – '.$person->getPhone();
		}
		$return['title'] = $label;
	}
}

?>