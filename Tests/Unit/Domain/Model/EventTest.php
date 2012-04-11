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
 * Test case for class Tx_Nboevents_Domain_Model_Event.
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
class Tx_Nboevents_Domain_Model_EventTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Nboevents_Domain_Model_Event
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Nboevents_Domain_Model_Event();
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
	public function getDateReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setDateForDateTimeSetsDate() { }
	
	/**
	 * @test
	 */
	public function getMaxreservationsReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getMaxreservations()
		);
	}

	/**
	 * @test
	 */
	public function setMaxreservationsForIntegerSetsMaxreservations() { 
		$this->fixture->setMaxreservations(12);

		$this->assertSame(
			12,
			$this->fixture->getMaxreservations()
		);
	}
	
	/**
	 * @test
	 */
	public function getReservationdateReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setReservationdateForDateTimeSetsReservationdate() { }
	
	/**
	 * @test
	 */
	public function getReservationnotesReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setReservationnotesForStringSetsReservationnotes() { 
		$this->fixture->setReservationnotes('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getReservationnotes()
		);
	}
	
	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setImagesForStringSetsImages() { 
		$this->fixture->setImages('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getImages()
		);
	}
	
	/**
	 * @test
	 */
	public function getReservationsReturnsInitialValueForObjectStorageContainingTx_Nboevents_Domain_Model_Reservation() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getReservations()
		);
	}

	/**
	 * @test
	 */
	public function setReservationsForObjectStorageContainingTx_Nboevents_Domain_Model_ReservationSetsReservations() { 
		$reservation = new Tx_Nboevents_Domain_Model_Reservation();
		$objectStorageHoldingExactlyOneReservations = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneReservations->attach($reservation);
		$this->fixture->setReservations($objectStorageHoldingExactlyOneReservations);

		$this->assertSame(
			$objectStorageHoldingExactlyOneReservations,
			$this->fixture->getReservations()
		);
	}
	
	/**
	 * @test
	 */
	public function addReservationToObjectStorageHoldingReservations() {
		$reservation = new Tx_Nboevents_Domain_Model_Reservation();
		$objectStorageHoldingExactlyOneReservation = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneReservation->attach($reservation);
		$this->fixture->addReservation($reservation);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneReservation,
			$this->fixture->getReservations()
		);
	}

	/**
	 * @test
	 */
	public function removeReservationFromObjectStorageHoldingReservations() {
		$reservation = new Tx_Nboevents_Domain_Model_Reservation();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($reservation);
		$localObjectStorage->detach($reservation);
		$this->fixture->addReservation($reservation);
		$this->fixture->removeReservation($reservation);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getReservations()
		);
	}
	
	/**
	 * @test
	 */
	public function getLocationsReturnsInitialValueForObjectStorageContainingTx_Nboevents_Domain_Model_Location() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getLocations()
		);
	}

	/**
	 * @test
	 */
	public function setLocationsForObjectStorageContainingTx_Nboevents_Domain_Model_LocationSetsLocations() { 
		$location = new Tx_Nboevents_Domain_Model_Location();
		$objectStorageHoldingExactlyOneLocations = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneLocations->attach($location);
		$this->fixture->setLocations($objectStorageHoldingExactlyOneLocations);

		$this->assertSame(
			$objectStorageHoldingExactlyOneLocations,
			$this->fixture->getLocations()
		);
	}
	
	/**
	 * @test
	 */
	public function addLocationToObjectStorageHoldingLocations() {
		$location = new Tx_Nboevents_Domain_Model_Location();
		$objectStorageHoldingExactlyOneLocation = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneLocation->attach($location);
		$this->fixture->addLocation($location);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneLocation,
			$this->fixture->getLocations()
		);
	}

	/**
	 * @test
	 */
	public function removeLocationFromObjectStorageHoldingLocations() {
		$location = new Tx_Nboevents_Domain_Model_Location();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($location);
		$localObjectStorage->detach($location);
		$this->fixture->addLocation($location);
		$this->fixture->removeLocation($location);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getLocations()
		);
	}
	
}
?>