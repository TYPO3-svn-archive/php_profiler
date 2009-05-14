<?php

/* - - - - - - - - - - - - - - - - - - - - -

 Title : PHP Quick Profiler MySQL Class
 Author : Created by Ryan Campbell
 URL : http://particletree.com/features/php-quick-profiler/

 Last Updated : April 22, 2009

 Description : A simple database wrapper that includes
 logging of queries.

- - - - - - - - - - - - - - - - - - - - - */

class MySqlDatabase {
	
	public $queryCount = 0;
	public $queries = array();
	
	
	/*-----------------------------------
	   				QUERY
	------------------------------------*/
	
	function query($sql) {			
		$start = $this->getTime();
		$rs = $GLOBALS['TYPO3_DB']->sql_query($sql);
		$this->queryCount += 1;
		$this->logQuery($sql, $start);
		if(!$rs) {
			throw new Exception('Could not execute query.');
		}
		return $rs;
	}
	
	/*-----------------------------------
	          	DEBUGGING
	------------------------------------*/
	
	function logQuery($sql, $start) {
		$query = array(
				'sql' => $sql,
				'time' => ($this->getTime() - $start)*1000
			);
		array_push($this->queries, $query);
	}
	
	function getTime() {
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		return $start;
	}
	
	public function getReadableTime($time) {
		$ret = $time;
		$formatter = 0;
		$formats = array('ms', 's', 'm');
		if($time >= 1000 && $time < 60000) {
			$formatter = 1;
			$ret = ($time / 1000);
		}
		if($time >= 60000) {
			$formatter = 2;
			$ret = ($time / 1000) / 60;
		}
		$ret = number_format($ret,3,'.','') . ' ' . $formats[$formatter];
		return $ret;
	}
		
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS['FE']['XCLASS']['ext/php_profiler/resources/lib/MySqlDatabase.php'])	{
	include_once($TYPO3_CONF_VARS['FE']['XCLASS']['ext/php_profiler/resources/lib/MySqlDatabase.php']);
}

?>
