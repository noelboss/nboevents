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
class Tx_Nboevents_Controller_ReservationController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 *
	 * reservationRepository
	 *
	 * @var Tx_Nboevents_Domain_Repository_ReservationRepository
	 */
	protected $reservationRepository;

	/**
	 * injectReservationRepository
	 *
	 * @param Tx_Nboevents_Domain_Repository_ReservationRepository $reservationRepository
	 * @return void
	 */
	public function injectReservationRepository(Tx_Nboevents_Domain_Repository_ReservationRepository $reservationRepository) {
		$this->reservationRepository = $reservationRepository;
	}

	/**
	 * personRepository
	 *
	 * @var Tx_Nboevents_Domain_Repository_PersonRepository
	 */
	protected $personRepository;

	/**
	 * injectPersonRepository
	 *
	 * @param Tx_Nboevents_Domain_Repository_PersonRepository $personRepository
	 * @return void
	 */
	public function injectPersonRepository(Tx_Nboevents_Domain_Repository_PersonRepository $personRepository) {
		$this->personRepository = $personRepository;
	}

	/**
	 * action new
	 *
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function newAction(Tx_Nboevents_Domain_Model_Event $event) {
		//$event = $this->request->hasArgument('event') ? $this->request->getArgument('event') : NULL;
		$newReservation = $this->request->hasArgument('newReservation') ? $this->request->getArgument('newReservation') : NULL;
		$newPerson = $this->request->hasArgument('newPerson') ? $this->request->getArgument('newPerson') : NULL;
		$e = $this->request->hasArgument('e') ? $this->request->getArgument('e') : '';

		if (!isset($newPerson)) {
			$uid = Tx_Nboevents_Utility_Cookies::getCookieValue('Reservation'.$event->getUid());
			if ($this->reservationRepository->countByUid($uid)) {
				$newReservation = $uid;
				$person = $this->reservationRepository->getPersonUid($newReservation);

				if ($this->personRepository->countByUid($person)) {
					$this->redirect(
							'edit', NULL, NULL, array(
							'newReservation' => $newReservation,
							'newPerson' => $person,
							'event' => $event,
						)
					);
				}
			}
			$pid = Tx_Nboevents_Utility_Cookies::getCookieValue('Person');
			$newPerson = $this->personRepository->findByUid($pid);
		}
		$this->view->assign('e', $e);
		$this->view->assign('event', $event);
		$this->view->assign('newPerson', $newPerson);
		$this->view->assign('newReservation', $newReservation);
	}

	/**
	 * action create
	 *
	 * @param $newReservation
	 * @param $newPerson
	 * @param $event
	 * @return void
	 * @dontverifyrequesthash
	 */
	public function createAction(Tx_Nboevents_Domain_Model_Reservation $newReservation, Tx_Nboevents_Domain_Model_Person $newPerson, Tx_Nboevents_Domain_Model_Event $event) {
		$this->reservationRepository->add($newReservation);

		if($event->getReservationkey()){
			if (!$this->request->hasArgument('reservationkey') || trim($this->request->getArgument('reservationkey')) !== $event->getReservationkey()) {
				$this->redirect(
					'new', NULL, NULL, array(
						'event' => $event->getUid(),
						'newReservation' => $this->request->getArgument('newReservation'),
						'newPerson' => $this->request->getArgument('newPerson'),
						'e' => array('reskey' => true)
				));
			}
		}
		if($event->getMaxreservationsperperson() > 0 && $event->getMaxreservationsperperson() < $newReservation->getCount()){
			$this->flashMessageContainer->add('<h3>Sorry, '.$newPerson->getFirstname().'</h3>Du kannst maximal ' . ($event->getMaxreservationsperperson()) . ' Person' . ($event->getMaxreservationsperperson() > 1 ? 'en': '') . ' anmelden.');
			$this->redirect(
				'new', NULL, NULL, array(
					'event' => $event->getUid(),
					'newReservation' => $this->request->getArgument('newReservation'),
					'newPerson' => $this->request->getArgument('newPerson'),
					'e' => array('reskey' => true)
			));
		}

		$remaining = $event->getRemaining();
		if($remaining < $newReservation->getCount()){
			$this->flashMessageContainer->add('<h3>Sorry, '.$newPerson->getFirstname().'</h3>Es hat leider nicht mehr Platz für ' . ($newReservation->getCount()) . ' Person' . ($newReservation->getCount() > 1 ? 'en': '') . '. Es hat noch Platz für '.$remaining.' Person'.($remaining > 1 ? 'en': '').'.');
			$this->redirect(
				'new', NULL, NULL, array(
					'event' => $event->getUid(),
					'newReservation' => $this->request->getArgument('newReservation'),
					'newPerson' => $this->request->getArgument('newPerson'),
					'e' => array('reskey' => true)
			));
		}

		$newReservation->setCount($newReservation->getCount());
		if (!$newPerson->getUid()) {
			$this->personRepository->add($newPerson);
		} else {
			$this->personRepository->update($newPerson);
		}

		//Enforce persistence
		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$persistenceManager->persistAll();

		$newPerson->addReservation($newReservation);
		$event->addReservation($newReservation);

		Tx_Nboevents_Utility_Cookies::setCookieValue('Reservation'.$event->getUid(), $newReservation->getUid());
		Tx_Nboevents_Utility_Cookies::setCookieValue('Person', $newPerson->getUid());

		$this->flashMessageContainer->add('<h3>Danke ' . ($newPerson->getFirstname()) . ' ' . ($newPerson->getLastname()) . '!</h3>Du hast Dich erfolgreicht für ' . ($newReservation->getCount()) . ' Person'.($newReservation->getCount() > 1 ? 'en': '').' angemeldet.');
		$this->redirect('show', 'Event', NULL, array('event' => $event->getUid()));
	}

	/**
	 * action edit
	 *
	 * @param $newReservation
	 * @param $newPerson
	 * @param $event
	 * @dontvalidate $newReservation
	 * @dontvalidate $newPerson
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function editAction(Tx_Nboevents_Domain_Model_Reservation $newReservation, Tx_Nboevents_Domain_Model_Person $newPerson, Tx_Nboevents_Domain_Model_Event $event) {
		$e = $this->request->hasArgument('e') ? $this->request->getArgument('e') : '';
		$this->view->assign('e', $e);
		$this->view->assign('event', $event);
		$this->view->assign('newReservation', $newReservation);
		$this->view->assign('newPerson', $newPerson);
	}

	/**
	 * action update
	 *
	 * @param $newReservation
	 * @param $newPerson
	 * @param $event
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function updateAction(Tx_Nboevents_Domain_Model_Reservation $newReservation, Tx_Nboevents_Domain_Model_Person $newPerson, Tx_Nboevents_Domain_Model_Event $event) {
		if($event->getReservationkey()){
			if (!$this->request->hasArgument('reservationkey') || trim($this->request->getArgument('reservationkey')) !== $event->getReservationkey()) {
				$this->redirect('edit', NULL, NULL, array(
					'newReservation' => $newReservation,
					'newPerson' => $newPerson,
					'event' => $event,
					'e' => array('reskey' => true)
				));
			}
		}

		if($event->getMaxreservationsperperson() < $newReservation->getCount()){
			$this->flashMessageContainer->add('<h3>Sorry, '.$newPerson->getFirstname().'</h3>Du kannst maximal ' . ($event->getMaxreservationsperperson()) . ' Person' . ($event->getMaxreservationsperperson() > 1 ? 'en': '') . ' anmelden.');
			$this->redirect(
				'edit', NULL, NULL, array(
					'newReservation' => $newReservation,
					'newPerson' => $newPerson,
					'event' => $event,
					'e' => array('reskey' => true)
			));
		}

		$remaining = $event->getRemaining();
		if ($this->reservationRepository->countByUid($newReservation->getUid()) > 0) {
			$currentReservation = $this->reservationRepository->findByUid($newReservation->getUid());
			$remaining = $remaining + $currentReservation->getCount();
		}

		if($remaining < $newReservation->getCount()){
			$this->flashMessageContainer->add('<h3>Sorry, '.$newPerson->getFirstname().'</h3>Es hat leider nicht mehr Platz für ' . ($newReservation->getCount()) . ' Person' . ($newReservation->getCount() > 1 ? 'en': '') . '. Es hat noch Platz für '.$remaining.' Person'.($remaining > 1 ? 'en': '').'.');
			$this->redirect(
				'edit', NULL, NULL, array(
					'newReservation' => $newReservation,
					'newPerson' => $newPerson,
					'event' => $event,
					'e' => array('reskey' => true)
			));
		}

		$this->reservationRepository->update($newReservation);
		$this->personRepository->update($newPerson);

		Tx_Nboevents_Utility_Cookies::setCookieValue('Person', $newPerson->getUid());

		$this->flashMessageContainer->add('<h3>Danke ' . ($newPerson->getFirstname()) . ' ' . ($newPerson->getLastname()) . '!</h3>Du hast Dich erfolgreicht für ' . ($newReservation->getCount()) . ' Person'.($newReservation->getCount() > 1 ? 'en': '').' angemeldet.');
		$this->redirect('show', 'Event', NULL, array('event' => $event->getUid()));
	}

	/**
	 * action delete
	 *
	 * @param $reservation
	 * @param $event
	 * @return void
	 */
	public function deleteAction(Tx_Nboevents_Domain_Model_Reservation $reservation, Tx_Nboevents_Domain_Model_Event $event) {
		$this->reservationRepository->remove($reservation);
		Tx_Nboevents_Utility_Cookies::setCookieValue('Reservation'.$event->getUid(), NULL);

		$this->flashMessageContainer->add('<h3>Danke!</h3>Deine Anmeldung wurde gelöscht.');
		$this->redirect('show', 'Event', NULL, array('event' => $event));
	}


}

?>