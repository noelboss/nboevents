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
class Tx_Nboevents_Controller_PersonController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * personRepository
	 *
	 * @var Tx_Nboevents_Domain_Repository_PersonRepository
	 */
	protected $personRepository;

	/**
	 * action list
	 *
	 * @return void
	 * @param Tx_Nboevents_Domain_Model_Person
	 */
	public function listAction() {
		$persons = $this->personRepository->findWithReservation();
		$this->view->assign('persons', $persons);
	}

	/**
	 * action new
	 *
	 * @param Tx_Nboevents_Domain_Model_Person
	 * @dontvalidate $newPerson
	 * @return void
	 */
	public function newAction(Tx_Nboevents_Domain_Model_Event $event, Tx_Nboevents_Domain_Model_Person $newPerson = NULL) {
		if (!isset($newPerson)) {
			$result = $GLOBALS['TSFE']->fe_user->getKey('ses', 'Tx_Nboevents_Domain_Model_Person');
			if ($result) {
				$person = $this->personRepository->findByUid($result);
				$this->redirect(
						'edit', NULL, NULL,
						array(
							'person' => $person,
							'event' => $event
						)
				);
			}
		}
		$this->view->assign('event', $event);
		$this->view->assign('newPerson', $newPerson);
	}

	/**
	 * action create
	 *
	 * @param Tx_Nboevents_Domain_Model_Person
	 * @return void
	 */
	public function createAction(Tx_Nboevents_Domain_Model_Person $newPerson, Tx_Nboevents_Domain_Model_Event $event) {
		$newPerson->addEvent($event);
		$newPerson->setCount($count, $event->getUid());
		$this->personRepository->add($newPerson);

		//Enforce persistence
		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$persistenceManager->persistAll();

		$GLOBALS['TSFE']->fe_user->setKey('ses', 'Tx_Nboevents_Domain_Model_Person', $newPerson->getUid());

		$this->flashMessageContainer->add('<h3>Danke!</h3>Sie haben sich erfolgreich für ' . ($newPerson->getCount()) . ' Person'.($newPerson->getCount() > 1 ? 'en' : '').' angemeldet.');
		$this->redirect('show', 'Event', NULL, array('event' => $event->getUid()));
	}

	/**
	 * action edit
	 *
	 * @param Tx_Nboevents_Domain_Model_Person
	 * @dontvalidate $person
	 * @return void
	 */
	public function editAction(Tx_Nboevents_Domain_Model_Person $person, Tx_Nboevents_Domain_Model_Event $event) {
		$this->view->assign('event', $event);
		$this->view->assign('person', $person);
	}

	/**
	 * action update
	 *
	 * @param Tx_Nboevents_Domain_Model_Person
	 * @return void
	 */
	public function updateAction(Tx_Nboevents_Domain_Model_Person $person, Tx_Nboevents_Domain_Model_Event $event) {
		$person->addEvent($event);
		$person->setCount($count, $event->getUid());
		$this->personRepository->update($person);

		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$persistenceManager->persistAll();

		$this->flashMessageContainer->add('<h3>Danke!</h3>Deine Anmeldung wurde angepasst.');
		$this->redirect('show', 'Event', NULL, array('event' => $event->getUid()));
	}

	/**
	 * injectReservationRepository
	 *
	 * @param Tx_Nboevents_Domain_Repository_PersonRepository $PersonRepository
	 * @return void
	 */
	public function injectPersonRepository(Tx_Nboevents_Domain_Repository_PersonRepository $personRepository) {
		$this->personRepository = $personRepository;
	}

}

?>