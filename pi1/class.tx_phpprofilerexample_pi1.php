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

require_once(PATH_tslib.'class.tslib_pibase.php');
require_once (t3lib_extMgm::extPath('php_profiler', 'classes/class.tx_phpprofiler.php'));

/**
 * Plugin 'PHP Quick Profiler Example' for the 'php_profiler_example' extension.
 *
 * @author	Julian Kleinhans <typo3@kj187.de>
 * @package	TYPO3
 * @subpackage	tx_phpprofilerexample
 */
class tx_phpprofilerexample_pi1 extends tslib_pibase {
	
	public $prefixId      = 'tx_phpprofilerexample_pi1';		// Same as class name
	public $scriptRelPath = 'pi1/class.tx_phpprofilerexample_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'php_profiler_example';	// The extension key.
	public $pi_checkCHash = true;
	
	public $profiler	= null;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	public function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		// fire up profiler
		$this->profiler = tx_phpprofiler::getInstance();
		$this->profiler->initialize();
		$this->profiler->setEnable();
		
		$this->sampleConsoleData();
		$this->sampleDatabaseData();
		$this->sampleMemoryLeak();
		$this->sampleSpeedComparison();

		$content = 'PHP Quick Profiler Example';
		
		return $this->pi_wrapInBaseClass($content);
	}
	
	/**
	 * Example of the 4 console functions
	 *   
	 * @return void
	 */
	public function sampleConsoleData() {
		try {
			$this->profiler->log('Begin logging data');
			$this->profiler->logMemory($this, 'PQP Example Class : Line ' . __LINE__);
			$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
			$this->profiler->log($this->conf);
			$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
			$this->profiler->logMemory($this, 'PQP Example Class : Line ' . __LINE__);
			$this->profiler->log('Ending log below with a sample error.');
			throw new Exception('Unable to write to log!');
		}
		catch(Exception $e) {
			$this->profiler->logError($e, 'Sample error logging.');
		}
	}
	
	/**
	 * Database object to log queries
	 *  
	 * @return void
	 */
	public function sampleDatabaseData() {		
		$sql = 'SELECT * FROM tt_content WHERE deleted = 0';
		$rs = $this->profiler->logQuery($sql);
		
		$sql = 'SELECT COUNT(uid) FROM pages';
		$rs = $this->profiler->logQuery($sql);
		
		$sql = 'SELECT COUNT(uid) FROM pages WHERE uid > 10';
		$rs = $this->profiler->logQuery($sql);
	}
	
	/**
	 * Example memory leak detected
	 * 
	 * @return void
	 */
	public function sampleMemoryLeak() {
		$ret = '';
		$longString = 'This is a really long string that when appended with the . symbol 
					  will cause memory to be duplicated in order to create the new string.';
		for ($i = 0; $i < 10; $i++) {
			$ret = $ret . $longString;
			$this->profiler->logMemory($ret, 'Watch memory leak -- iteration ' . $i);
		}
	}
	
	/**
	 * Point in time speed marks
	 *  
	 * @return void
	 */
	public function sampleSpeedComparison() {
		$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
		$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
		$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
		$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
		$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
		$this->profiler->logSpeed('Time taken to get to line ' . __LINE__);
	}	
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/php_profiler_example/pi1/class.tx_phpprofilerexample_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/php_profiler_example/pi1/class.tx_phpprofilerexample_pi1.php']);
}

?>