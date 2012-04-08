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
 * @package sjevents
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Sjevents_Domain_Model_Location extends Tx_Extbase_DomainObject_AbstractEntity {

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
	 * Address
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $address;

	/**
	 * coordinates
	 *
	 * @var string
	 */
	protected $coordinates;

	/**
	 * Events
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Sjevents_Domain_Model_Event>
	 */
	protected $events;

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
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		//$search = array("\r\n", "\n");
		//return str_replace($search, ',', $this->address);
		return $this->address;
	}

	/**
	 * Returns the coded address
	 *
	 * @return string $address
	 */
	public function getCodedAddress() {
		$search = array("\r\n", "\n");
		return str_replace($search, ', ', $this->address);
		//return $this->address;
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
	 * Returns the coordinates
	 *
	 * @return string $coordinates
	 */
	public function getCoordinates() {
		return $this->coordinates;
	}

	/**
	 * Sets the coordinates
	 *
	 * @param string $coordinates
	 * @return void
	 */
	public function setCoordinates($coordinates) {
		$this->coordinates = $coordinates;
	}

	/**
	 * Adds a Event
	 *
	 * @param Tx_Sjevents_Domain_Model_Event $event
	 * @return void
	 */
	public function addEvent(Tx_Sjevents_Domain_Model_Event $event) {
		$this->events->attach($event);
	}

	/**
	 * Removes a Event
	 *
	 * @param Tx_Sjevents_Domain_Model_Event $eventToRemove The Event to be removed
	 * @return void
	 */
	public function removeEvent(Tx_Sjevents_Domain_Model_Event $eventToRemove) {
		$this->events->detach($eventToRemove);
	}

	/**
	 * Returns the events
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Sjevents_Domain_Model_Event> $events
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * Sets the events
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Sjevents_Domain_Model_Event> $events
	 * @return void
	 */
	public function setEvents(Tx_Extbase_Persistence_ObjectStorage $events) {
		$this->events = $events;
	}

}
?>