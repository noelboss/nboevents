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
 * Test case for class Tx_Nboevents_Domain_Model_Person.
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
class Tx_Nboevents_Domain_Model_PersonTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Nboevents_Domain_Model_Person
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Nboevents_Domain_Model_Person();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getLastnameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLastnameForStringSetsLastname() { 
		$this->fixture->setLastname('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLastname()
		);
	}
	
	/**
	 * @test
	 */
	public function getFirstnameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFirstnameForStringSetsFirstname() { 
		$this->fixture->setFirstname('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFirstname()
		);
	}
	
	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() { 
		$this->fixture->setEmail('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getEmail()
		);
	}
	
	/**
	 * @test
	 */
	public function getPhoneReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPhoneForStringSetsPhone() { 
		$this->fixture->setPhone('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPhone()
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
	
}
?>