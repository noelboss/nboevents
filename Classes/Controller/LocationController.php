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
 * @package sjevents
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Sjevents_Controller_LocationController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * locationRepository
	 *
	 * @var Tx_Sjevents_Domain_Repository_LocationRepository
	 */
	protected $locationRepository;

	/**
	 * eventRepository
	 *
	 * @var Tx_Sjevents_Domain_Repository_EventRepository
	 */
	protected $eventRepository;

	/**
	 * injectEventRepository
	 *
	 * @param Tx_Sjevents_Domain_Repository_EventRepository $eventRepository
	 * @return void
	 */
	public function injectEventRepository(Tx_Sjevents_Domain_Repository_EventRepository $eventRepository) {
		$this->eventRepository = $eventRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$locations = $this->locationRepository->findAll();
		$this->view->assign('locations', $locations);
	}

	/**
	 * action show
	 *
	 * @param $location
	 * @return void
	 */
	public function showAction(Tx_Sjevents_Domain_Model_Location $location) {
		$event = $this->request->hasArgument('event') ? $this->request->getArgument('event') : NULL;

		$this->view->assign('event', $event);
		$this->view->assign('location', $location);
	}

	/**
	 * action new
	 *
	 * @param $newLocation
	 * @dontvalidate $newLocation
	 * @return void
	 */
	public function newAction(Tx_Sjevents_Domain_Model_Location $newLocation = NULL) {
		$this->view->assign('newLocation', $newLocation);
	}

	/**
	 * action create
	 *
	 * @param $newLocation
	 * @return void
	 */
	public function createAction(Tx_Sjevents_Domain_Model_Location $newLocation) {
		$this->locationRepository->add($newLocation);
		$this->flashMessageContainer->add('Your new Location was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $location
	 * @return void
	 */
	public function editAction(Tx_Sjevents_Domain_Model_Location $location) {
		$this->view->assign('location', $location);
	}

	/**
	 * action update
	 *
	 * @param $location
	 * @return void
	 */
	public function updateAction(Tx_Sjevents_Domain_Model_Location $location) {
		$this->locationRepository->update($location);
		$this->flashMessageContainer->add('Your Location was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $location
	 * @return void
	 */
	public function deleteAction(Tx_Sjevents_Domain_Model_Location $location) {
		$this->locationRepository->remove($location);
		$this->flashMessageContainer->add('Your Location was removed.');
		$this->redirect('list');
	}

	/**
	 * injectLocationRepository
	 *
	 * @param Tx_Sjevents_Domain_Repository_LocationRepository $locationRepository
	 * @return void
	 */
	public function injectLocationRepository(Tx_Sjevents_Domain_Repository_LocationRepository $locationRepository) {
		$this->locationRepository = $locationRepository;
	}

}

?>