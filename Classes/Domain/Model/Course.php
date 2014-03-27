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
class Tx_Nboevents_Domain_Model_Course extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Price
	 *
	 * @var string
	 */
	protected $price;

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Type
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * Description
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * Events of this course
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Event>
	 */
	protected $events;



	/**
	 * Images
	 *
	 * @var string
	 */
	protected $images;

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
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * Returns the type
	 *
	 * @return string $type
	 */
	public function getType() {
		if(!$this->typeIsLink()){
			return $this->type;
		}
	}

	/**
	 * Sets the type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns true if the type is a url
	 *
	 * @return boolean $isurl
	 */
	private function typeIsLink() {
		$isurl = false;
		if(file_exists(PATH_site.$this->type) && $this->type){
			$isurl = PATH_site.$this->type;
		}
		else if (count(explode('/', $this->type)) > 1){
			$isurl = $GLOBALS['TSFE']->baseUrl.$this->type;
		}
		else if (count(explode('://', $this->type)) > 1){
			$isurl = $this->type;
		}
		return $isurl;
	}

	/**
	 * Returns the UID of the corse or the link to the file linked in type
	 *
	 * @return string $link
	 */
	public function getLink() {
		return $this->typeIsLink();
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
		$eventRepository = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_EventRepository');
		return $eventRepository->findByCourse($this->getUid());
	}

	/**
	 * Returns the events
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Event> $events
	 */
	public function getAllevents() {
		$eventRepository = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_EventRepository');
		return $eventRepository->findAllByCourse($this->getUid());
	}

	/**
	 * Returns the next event
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Nboevents_Domain_Model_Event> $events
	 */
	public function getNextevent() {
		$eventRepository = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_EventRepository');
		return $eventRepository->findByCourse($this->getUid(), 1);
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
	 * Returns the price
	 *
	 * @return string $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param string $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
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

}
?>