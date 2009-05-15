<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Julian Kleinhans <typo3@kj187.de>
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

require_once (t3lib_extMgm::extPath('php_profiler', 'classes/class.tx_phpprofiler.php'));

/**
 * Plugin 'PHP Quick Profiler' for the 'php_profiler' extension.
 *
 * @author		Julian Kleinhans <typo3@kj187.de>
 * @package		TYPO3
 * @subpackage	tx_phpprofilere
 */

class tx_phpprofiler_eofe {
	
	/**
	 * Output profiler
	 * 
	 * @param 	$params
	 * @param 	$ref
	 * @return 	string
	 */
	public function fe_eofe(&$params, $ref) {
		$profiler = tx_phpprofiler::getInstance();
		if (true == $profiler->isEnable()) {
			echo $profiler->getContent();
		}
	}
	
}

?>