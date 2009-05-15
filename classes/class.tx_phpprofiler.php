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

require_once (t3lib_extMgm::extPath('php_profiler', 'resources/pqp/classes/PhpQuickProfiler.php'));
require_once (t3lib_extMgm::extPath('php_profiler', 'resources/lib/MySqlDatabase.php'));

/**
 * Plugin 'PHP Quick Profiler' for the 'php_profiler' extension.
 * This class serves as a wrapper around a global php variable, debugger_logs, that we have created.
 * 
 * Original script:
 * Title : PHP Quick Profiler Console Class
 * Author : Created by Ryan Campbell
 * URL : http://particletree.com/features/php-quick-profiler/
 *
 * @author		Julian Kleinhans <typo3@kj187.de>
 * @package		TYPO3
 * @subpackage	tx_phpprofiler
 */
class tx_phpprofiler {
	
	const GETPARAM_KEY			= 'phpprofiler';
	const PQP_PATH 				= 'resources/pqp/';

	protected $enable			= false;

	static private $profiler	= null;
	static private $db			= null;	
	static private $instance 	= null;	
	
	/**
	 * Get singleton instance
	 * 
	 * @return 	tx_phpprofiler
	 */
	static public function getInstance() {
		if (null === self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}	
	
	private function __construct(){}
	private function __clone(){}
	
	/**
	 * Initialize
	 * 
	 * @return 	void
	 */
	public function initialize() {		
		if (null === self::$profiler) self::$profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime(), '/' . t3lib_extMgm::siteRelPath('php_profiler') . self::PQP_PATH);
		if (null === self::$db) self::$db = t3lib_div::makeInstance('MySqlDatabase');
	}
	
	/**
	 * Output content
	 * Use in Hook - hook_eofe
	 * 
	 * @return	string
	 */
	public function getContent() {
		$content = '';
		if (true == $this->isEnable()) {
			ob_start();
			self::$profiler->display(self::$db);
			$content = ob_get_clean();			
		}
		return $content;
	}

	/**
	 * Enable profiler 
	 * 
	 * @return 	void
	 */
	public function setEnable() {
		$this->enable = true;
	}
	
	/**
	 * Enable profiler only if GET param is set
	 * Example http://www.domain.com/?phpprofiler=1
	 * 
	 * @return 	void
	 */
	public function setEnableViaGetParam() {
		if (t3lib_div::_GET(self::GETPARAM_KEY)) {
			$this->enable = true;
		}
	}

	/**
	 * Is profiler enabled
	 * 
	 * @return 	boolean
	 */
	public function isEnable() {
		return $this->enable;
	}	
	
	/**
	 * Clean all previous logs
	 * 
	 * @param	string	$message
	 * @return 	void
	 */
	public function clearLogs($message = 'clean debugger_logs') {
		unset($GLOBALS['debugger_logs']);
		$trace = debug_backtrace();
		$this->log($message . ' (' . $trace[0]['file'] . ':' . $trace[0]['line'] . ')');
	}
	
	/****************************************************
	 * Logger
	 * 
	 */
	
	/**
	 * Log a variable to console
	 * 
	 * @param 	$data
	 * @return 	void
	 */
	public function log($data) {
		Console::log($data);
	}
	
	/**
	 * Log memory usage of vaiable or entire script
	 * 
	 * @param 	object $object
	 * @param 	string	$name
	 * @return 	void
	 */
	public function logMemory($object = false, $name = 'PHP') {
		Console::logMemory($object, $name);
	}
	
	/**
	 * Log a php exception object
	 * 
	 * @param 	$exception
	 * @param 	string $message
	 * @return 	void
	 */
	public function logError($exception, $message) {
		Console::logError($exception, $message);
	}
	
	/**
	 * Point in time speed snapshot
	 * 
	 * @param 	string $name
	 * @return 	void
	 */
	public function logSpeed($name = 'Point in Time') {
		Console::logSpeed($name);
	}
	
	/**
	 * A simple database wrapper that includes logging of queries
	 * 
	 * @param 	string $query
	 * @return 	void
	 */
	public function logQuery($query) {
		self::$db->query($query);
	}
	
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS['FE']['XCLASS']['ext/php_profiler/classes/class.tx_phpprofiler.php'])	{
	include_once($TYPO3_CONF_VARS['FE']['XCLASS']['ext/php_profiler/classes/class.tx_phpprofiler.php']);
}

?>