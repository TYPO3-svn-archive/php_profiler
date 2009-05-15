<?php

########################################################################
# Extension Manager/Repository config file for ext: "php_profiler"
#
# Auto generated 14-05-2009 23:32
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'PHP Quick Profiler',
	'description' => 'Code reviews play an integral part in the development process for making quality software. We can find out security holes, memory leaks, poor queries and heavy file structures from code reviews. Unfortunately, these reviews are also very time consuming.

We spend a lot of time echoing queries, memory stats and objects to the browser just to see how they are being used in the code. To reduce this repetition, Ryan Campbell has invested some time creating the PHP Quick Profiler (PQP). It’s a small tool (think Firebug for PHP) to provide profiling and debugging related information to developers without needing them to add a lot of programmatic overhead to their code.

Now, we only need to toggle one config setting to true and we can have access to an automated tool to help create a faster and more consistent review experience. Since anyone can use it, PQP also gives the initial developer an idea of where their code stands before the review.

Example Extension: php_profiler_example',
	'category' => 'misc',
	'author' => 'Julian Kleinhans',
	'author_email' => 'typo3@kj187.de',
	'shy' => '',
	'dependencies' => 'cms',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.0.1',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:17:{s:9:"ChangeLog";s:4:"ab0c";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"807c";s:32:"classes/class.tx_phpprofiler.php";s:4:"0048";s:19:"doc/wizard_form.dat";s:4:"9475";s:20:"doc/wizard_form.html";s:4:"99cf";s:31:"resources/lib/MySqlDatabase.php";s:4:"4da2";s:24:"resources/pqp/README.txt";s:4:"82f9";s:25:"resources/pqp/display.php";s:4:"fe27";s:23:"resources/pqp/index.php";s:4:"9c6d";s:21:"resources/pqp/pqp.tpl";s:4:"6234";s:33:"resources/pqp/classes/Console.php";s:4:"9e0a";s:39:"resources/pqp/classes/MySqlDatabase.php";s:4:"76ca";s:42:"resources/pqp/classes/PhpQuickProfiler.php";s:4:"32a5";s:25:"resources/pqp/css/pQp.css";s:4:"8023";s:32:"resources/pqp/images/overlay.gif";s:4:"a899";s:29:"resources/pqp/images/side.png";s:4:"31fb";}',
	'suggests' => array(
	),
);

?>