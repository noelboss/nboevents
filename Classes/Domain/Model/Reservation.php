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
class Tx_Nboevents_Domain_Model_Reservation extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Create Date
	 *
	 * @var DateTime
	 */
	protected $tstamp;

	/**
	 * Pid
	 *
	 * @var integer
	 */
	protected $pid;

	/**
	 * Notes
	 *
	 * @var string
	 */
	protected $notes;

	/**
	 * Reservation for Events
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Event>
	 */
	protected $events;

	/**
	 * Reservation for Person
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Person>
	 */
	protected $persons;

	/**
	 * Number of reservations
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $count;

	/**
	 * Person
	 *
	 * @var Tx_Nboevents_Domain_Model_Person
	 * @lazy
	 */
	protected $person;

	/**
	 * Event
	 *
	 * @var Tx_Nboevents_Domain_Model_Event
	 * @lazy
	 */
	protected $event;

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
		$this->events = new Tx_Extbase_Persistence_ObjectStorage();
		$this->persons = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the count
	 *
	 * @return integer $count
	 */
	public function getCount() {
		if($this->count < 1){
			return 1;
		}
		return $this->count;
	}

	/**
	 * Sets the count
	 *
	 * @param integer $count
	 * @return void
	 */
	public function setCount($count) {
		$this->count = $count;
	}

	/**
	 * Returns the Label for TCA
	 *
	 * @param array $params
	 * @return integer $remaining
	 */
	public function getLabel(&$return) {
		$uid = $return['row']['uid'];
		$repo = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_ReservationRepository');
		$return['title'] = $repo->findLabel($uid);
	}

	/**
	 * Returns the pid
	 *
	 * @return string $pid
	 */
	public function getPid() {
		return $this->pid;
	}

	/**
	 * Sets the pid
	 *
	 * @param string $pid
	 * @return void
	 */
	public function setPid($pid) {
		$this->pid = $pid;
	}

	/**
	 * Returns the notes
	 *
	 * @return string $notes
	 */
	public function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the notes
	 *
	 * @param string $notes
	 * @return void
	 */
	public function setNotes($notes) {
		$this->notes = $notes;
	}

	/**
	 * Adds a Event
	 *
	 * @param Tx_Nboevents_Domain_Model_Event $event
	 * @return void
	 */
	public function addEvent(Tx_Nboevents_Domain_Model_Event $event) {
		$this->events->attach($event);
	}

	/**
	 * Removes a Event
	 *
	 * @param Tx_Nboevents_Domain_Model_Event $eventToRemove The Event to be removed
	 * @return void
	 */
	public function removeEvent(Tx_Nboevents_Domain_Model_Event $eventToRemove) {
		$this->events->detach($eventToRemove);
	}

	/**
	 * Returns the events
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Event> $events
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * Returns the event
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Event> $event
	 */
	public function getEvent() {
		return $this->event;
	}

	/**
	 * Returns the totel
	 *
	 * @return integer $count
	 */
	public function getTotal() {
		if($this->getEvent() && $this->getEvent()->getCourse() && $this->getEvent()->getCourse()->getPrice()){
			return $this->getCount() * $this->getEvent()->getCourse()->getPrice();
		} else {
			return 0;
		}
	}

	/**
	 * Sets the events
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Event> $events
	 * @return void
	 */
	public function setEvents(Tx_Extbase_Persistence_ObjectStorage $events) {

		$this->events = $events;
	}

	/**
	 * Adds a Person
	 *
	 * @param Tx_Nboevents_Domain_Model_Person $person
	 * @return void
	 */
	public function addPerson(Tx_Nboevents_Domain_Model_Person $person) {
		$this->persons->attach($person);
	}

	/**
	 * Removes a Person
	 *
	 * @param Tx_Nboevents_Domain_Model_Person $personToRemove The Person to be removed
	 * @return void
	 */
	public function removePerson(Tx_Nboevents_Domain_Model_Person $personToRemove) {
		$this->persons->detach($personToRemove);
	}

	/**
	 * Returns the persons
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Person> $persons
	 */
	public function getPersons() {
		return $this->persons;
	}

	/**
	 * Returns the person
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Person> $person
	 */
	public function getPerson() {
		return $this->person;
	}

	/**
	 * Returns the tstamp
	 *
	 * @return DateTime $tstamp
	 */
	public function getTstamp() {
		return $this->tstamp;
	}

	/**
	 * Sets the persons
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Person> $persons
	 * @return void
	 */
	public function setPersons(Tx_Extbase_Persistence_ObjectStorage $persons) {
		$this->persons = $persons;
	}

}

?>