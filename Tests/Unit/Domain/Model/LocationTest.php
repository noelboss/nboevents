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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_Nboevents_Domain_Model_Location.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Events
 *
 * @author Noel Bossart <n.company@me.com>
 */
class Tx_Nboevents_Domain_Model_LocationTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Nboevents_Domain_Model_Location
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Nboevents_Domain_Model_Location();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getAddressReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAddressForStringSetsAddress() { 
		$this->fixture->setAddress('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAddress()
		);
	}
	
	/**
	 * @test
	 */
	public function getCoordinatesReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCoordinatesForStringSetsCoordinates() { 
		$this->fixture->setCoordinates('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCoordinates()
		);
	}
	
	/**
	 * @test
	 */
	public function getEventsReturnsInitialValueForObjectStorageContainingTx_Nboevents_Domain_Model_Event() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getEvents()
		);
	}

	/**
	 * @test
	 */
	public function setEventsForObjectStorageContainingTx_Nboevents_Domain_Model_EventSetsEvents() { 
		$event = new Tx_Nboevents_Domain_Model_Event();
		$objectStorageHoldingExactlyOneEvents = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneEvents->attach($event);
		$this->fixture->setEvents($objectStorageHoldingExactlyOneEvents);

		$this->assertSame(
			$objectStorageHoldingExactlyOneEvents,
			$this->fixture->getEvents()
		);
	}
	
	/**
	 * @test
	 */
	public function addEventToObjectStorageHoldingEvents() {
		$event = new Tx_Nboevents_Domain_Model_Event();
		$objectStorageHoldingExactlyOneEvent = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneEvent->attach($event);
		$this->fixture->addEvent($event);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneEvent,
			$this->fixture->getEvents()
		);
	}

	/**
	 * @test
	 */
	public function removeEventFromObjectStorageHoldingEvents() {
		$event = new Tx_Nboevents_Domain_Model_Event();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($event);
		$localObjectStorage->detach($event);
		$this->fixture->addEvent($event);
		$this->fixture->removeEvent($event);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getEvents()
		);
	}
	
}
?>