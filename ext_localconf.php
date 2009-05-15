<?php
if (!defined ('TYPO3_MODE')) { die ('Access denied.'); }

$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['hook_eofe']['tx_phpprofiler'] = 'EXT:php_profiler/hooks/class.tx_phpprofiler_eofe.php:&tx_phpprofiler_eofe->fe_eofe';

?>