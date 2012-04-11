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
class Tx_Nboevents_Controller_EventController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * eventRepository
	 *
	 * @var Tx_Nboevents_Domain_Repository_EventRepository
	 */
	protected $eventRepository;

	/**
	 * injectEventRepository
	 *
	 * @param Tx_Nboevents_Domain_Repository_EventRepository $eventRepository
	 * @return void
	 */
	public function injectEventRepository(Tx_Nboevents_Domain_Repository_EventRepository $eventRepository) {
		$this->eventRepository = $eventRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$events = $this->eventRepository->findAll();
		$this->view->assign('events', $events);
	}

	/**
	 * action show
	 *
	 * @param $event
	 * @return void
	 */
	public function showAction(Tx_Nboevents_Domain_Model_Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * action new
	 *
	 * @param $newEvent
	 * @dontvalidate $newEvent
	 * @return void
	 */
	public function newAction(Tx_Nboevents_Domain_Model_Event $newEvent = NULL) {
		$this->view->assign('newEvent', $newEvent);
	}

	/**
	 * action create
	 *
	 * @param $newEvent
	 * @return void
	 */
	public function createAction(Tx_Nboevents_Domain_Model_Event $newEvent) {
		$newEvent->setImages($this->addImage('newEvent'));
		$this->eventRepository->add($newEvent);
		$this->flashMessageContainer->add('Your new Event was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $event
	 * @return void
	 */
	public function editAction(Tx_Nboevents_Domain_Model_Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * action update
	 *
	 * @param $event
	 * @return void
	 */
	public function updateAction(Tx_Nboevents_Domain_Model_Event $event) {
		$event->setImages($this->addImage());
		$this->eventRepository->update($event);
		$this->flashMessageContainer->add('Your Event was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $event
	 * @return void
	 */
	public function deleteAction(Tx_Nboevents_Domain_Model_Event $event) {
		$this->eventRepository->remove($event);
		$this->flashMessageContainer->add('Your Event was removed.');
		$this->redirect('list');
	}

	/**
	 * add Image
	 *
	 * @param $name boolean
	 * @return string
	 */
	private function addImage($name = "event") {
		if ($_FILES['tx_nboevents_events']) {
			$basicFileFunctions = t3lib_div::makeInstance('t3lib_basicFileFunctions');
			$fileName = $basicFileFunctions->getUniqueName($_FILES['tx_nboevents_events']['name'][$name]['images'], t3lib_div::getFileAbsFileName('uploads/tx_nboevents/'));
			t3lib_div::upload_copy_move($_FILES['tx_nboevents_events']['tmp_name'][$name]['images'], $fileName);
			return basename($fileName);
		}
	}

}

?>