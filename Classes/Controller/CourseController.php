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
 ***************************************************************/

/**
 *
 *
 * @package nboevents
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Nboevents_Controller_CourseController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * courseRepository
	 *
	 * @var Tx_Nboevents_Domain_Repository_CourseRepository
	 */
	protected $courseRepository;

	/**
	 * injectCourseRepository
	 *
	 * @param Tx_Nboevents_Domain_Repository_CourseRepository $courseRepository
	 * @return void
	 */
	public function injectCourseRepository(Tx_Nboevents_Domain_Repository_CourseRepository $courseRepository) {
		$this->courseRepository = $courseRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$courses = $this->courseRepository->findAll();
		$this->view->assign('courses', $courses);
	}

	/**
	 * events list
	 *
	 * @return void
	 */
	public function eventsAction() {
		$courses = $this->courseRepository->findAll();
		$this->view->assign('courses', $courses);
	}



	/**
	 * action show
	 *
	 * @param $course
	 * @return void
	 */
	public function showAction(Tx_Nboevents_Domain_Model_Course $course) {
		$link = $course->getLink();
		if($link !== false){
		    if (file_exists($link)) {
				header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
				header("Cache-Control: public"); // needed for i.e.
				header("Content-Type: ".mime_content_type($link));
				header("Content-Transfer-Encoding: ".mb_detect_encoding($link));
				header("Content-Length:".filesize($link));
				header("Content-Disposition: attachment; filename=".basename($link));
				readfile($link);
				die();
			} else {
				header( 'Location: '.$link );
			}
		} else {
			$this->view->assign('course', $course);
		}
	}

}
?>