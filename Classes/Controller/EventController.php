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
	 * courseRepository
	 *
	 * @var Tx_Nboevents_Domain_Repository_CourseRepository
	 */
	protected $courseRepository;


	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->courseRepository = t3lib_div::makeInstance('Tx_Nboevents_Domain_Repository_CourseRepository');
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction(){
		if($GLOBALS['TSFE']->beUserLogin || true){
			$courses = $this->courseRepository->findAll();
			$this->view->assign('courses', $courses);
		} else {
			$this->view->assign('login', 1);
		}
	}

	/**
	 * action show
	 *
	 * @param $event
	 * @return void
	 */
	public function showAction(Tx_Nboevents_Domain_Model_Event $event) {
		if($GLOBALS['TSFE']->beUserLogin || true){
			$this->view->assign('event', $event);
		} else {
			$this->view->assign('login', 1);
		}
	}
}

?>