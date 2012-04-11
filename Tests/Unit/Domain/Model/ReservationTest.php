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
 * Test case for class Tx_Nboevents_Domain_Model_Reservation.
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
class Tx_Nboevents_Domain_Model_ReservationTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Nboevents_Domain_Model_Reservation
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Nboevents_Domain_Model_Reservation();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getCountReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCount()
		);
	}

	/**
	 * @test
	 */
	public function setCountForIntegerSetsCount() { 
		$this->fixture->setCount(12);

		$this->assertSame(
			12,
			$this->fixture->getCount()
		);
	}
	
	/**
	 * @test
	 */
	public function getNoteReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNoteForStringSetsNote() { 
		$this->fixture->setNote('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNote()
		);
	}
	
	/**
	 * @test
	 */
	public function getPersonReturnsInitialValueForTx_Nboevents_Domain_Model_Person() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getPerson()
		);
	}

	/**
	 * @test
	 */
	public function setPersonForTx_Nboevents_Domain_Model_PersonSetsPerson() { 
		$dummyObject = new Tx_Nboevents_Domain_Model_Person();
		$this->fixture->setPerson($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getPerson()
		);
	}
	
	/**
	 * @test
	 */
	public function getEventReturnsInitialValueForTx_Nboevents_Domain_Model_Event() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getEvent()
		);
	}

	/**
	 * @test
	 */
	public function setEventForTx_Nboevents_Domain_Model_EventSetsEvent() { 
		$dummyObject = new Tx_Nboevents_Domain_Model_Event();
		$this->fixture->setEvent($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getEvent()
		);
	}
	
}
?>