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
	 * action show
	 *
	 * @param $reservation
	 * @return void
	 */
	public function showAction(Tx_Nboevents_Domain_Model_Reservation $reservation) {
		$this->view->assign('reservation', $reservation);
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$reservations = $this->reservationRepository->findAll();
		$this->view->assign('reservations', $reservations);
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
			$puid = Tx_Nboevents_Utility_Cookies::getCookieValue('Person');
			$secure = Tx_Nboevents_Utility_Cookies::getCookieValue('Session');

			if($secure === md5($puid+'e332b3eb1ba44921b72c2bb006e54550')) {
				$newPerson = $this->personRepository->findByUid($puid);
			}
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

		//echo 'Reservation: '.($event->getHasReservation()? 'true' : 'false');
		//die();

		if($event->getHasReservation()){
			$this->redirect('show', 'Course', NULL, array('course' => $event->getCourse()));
		}

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

		$remaining = $event->getRemaining();
		if($remaining < $newReservation->getCount()){
			$this->flashMessageContainer->add('<h3>Entschuldigung, ' . ($newPerson->getFirstname()) . ' ' . ($newPerson->getLastname()) . '</h3>Es hat leider nicht mehr Platz für ' . ($newReservation->getCount()) . ' Person' . ($newReservation->getCount() > 1 ? 'en': '') . '. Es hat noch Platz für '.$remaining.' Person'.($remaining > 1 ? 'en': '').'.');
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

		$newReservation->addPerson($newPerson);
		$newReservation->addEvent($event);

		$this->reservationRepository->add($newReservation);

		//Enforce persistence
		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$persistenceManager->persistAll();

		//Tx_Nboevents_Utility_Cookies::setCookieValue('Reservation'.$event->getUid(), $newReservation->getUid());
		$puid = $newPerson->getUid();


		//Tx_Nboevents_Utility_Cookies::setCookieValue('Session', md5($puid+'e332b3eb1ba44921b72c2bb006e54550'));
		//Tx_Nboevents_Utility_Cookies::setCookieValue('Person', $puid);
		$mailsent = $this->sendStatusMail($newPerson, $newReservation);
		$this->flashMessageContainer->add(
		'<h3>Danke ' . ($newPerson->getFirstname()) . ' ' . ($newPerson->getLastname()) . '!</h3>Sie haben sich erfolgreich für ' . ($newReservation->getCount()) . ' Person'.($newReservation->getCount() > 1 ? 'en' : '').' angemeldet'
			.($mailsent? ' und erhalten von uns eine Bestätigung per E-Mail an '.$newPerson->getEmail().'.': '. Eine Bestätigung per E-Mail konnte nicht gesendet werden.')
		);

		$this->redirect('show', 'Course', NULL, array('course' => $event->getCourse()));
	}

	/**
	* Creates a new entry and send a status mail
	*
	* @param <Tx_Nboevents_Domain_Model_Person> $newPerson
	* @param <Tx_Nboevents_Domain_Model_Reservation> $newReservation
	*
	*/
	private function sendStatusMail(Tx_Nboevents_Domain_Model_Person $newPerson, Tx_Nboevents_Domain_Model_Reservation $newReservation) {
		// mail content

		$name = $newPerson->getFirstname().' '.$newPerson->getLastname();
		$event = $newReservation->getEvent()->getEventnr().' '.$newReservation->getEvent()->getCourse()->getTitle();
		$notes = $newReservation->getNotes();

		$mail = '<h3>Guten Tag '.$name.'</h3>'
			.'<p>Vielen Dank für Ihre Anmeldung. <br/>'
			.'Gerne bestätigen wir Ihnen Ihre Anmeldung für folgendes Angebot:</p>'
			.'<ul><li><strong>Kurs:</strong> '.$event
			.'</li><li><strong>Anzahl Personen:</strong> '.$newReservation->getCount()
			.'</li><li><strong>Rechnungsnummer:</strong> '.$newReservation->getEvent()->getEventnr().'.'.$newReservation->getUid()
			.($notes ? '</li><li><strong>Ihre Anmerkung:</strong> '.$newReservation->getNotes(): '')
			.'</li></ul><p>Sie werden in den nächsten Tage eine Rechnung von uns an folgende Adresse erhalten:</p>'
			.'<p>'.$name
			.'<br/>'.nl2br($newPerson->getAddress())
			.'</p>'
			.'<p>Herzlichen Dank für Ihre Anmeldung. Wir freuen uns sie am '.$newReservation->getEvent()->getDate()->format('d.m.Y').' um '.$newReservation->getEvent()->getDate()->format('H:i').' im BissFest begrüssen zu dürfen.</p>'
			.'<p>Agnes Feurer & Angela Hassler</p>';


		//mail versenden
		/** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
		$message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage')
			->setSubject('BissFest – Anmeldebestätigung: '. $event)
			->setFrom(array('info@bissfest.ch' => 'BissFest'))
			->setTo(array($newPerson->getEmail() => $name));

		// Possible attachments here
		//foreach ($attachments as $attachment) {
		//    $message->attach($attachment);
		//}

		//Plain text example
		$message->setBody($mail, 'text/plain');

		// HTML Email
		$message->setBody($mail, 'text/html');

		$message->send();

		return $message->isSent();
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
	 * action billed
	 *
	 * @param $reservation
	 * @return void
	 */
	public function billedAction(Tx_Nboevents_Domain_Model_Reservation $reservation) {
		$reservation->setPid(1*$this->settings['billedPid']);
		$reservation->setPayuntil();
		$reservation->setBillsent();
		$this->reservationRepository->update($reservation);

		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$persistenceManager->persistAll();

		$this->view->assign('reservation', $reservation);
	}

	/**
	 * action payed
	 *
	 * @param $reservation
	 * @return void
	 */
	public function payedAction(Tx_Nboevents_Domain_Model_Reservation $reservation) {
		$reservation->setPid(1*$this->settings['payedPid']);
		$reservation->setPayed();
		$this->reservationRepository->update($reservation);

		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
		$persistenceManager->persistAll();

		$this->view->assign('reservation', $reservation);
	}

}

?>