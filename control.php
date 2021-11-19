<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

switch ($argv[1]) 
{
	case '1':
		start_server($server_path, $screen_name);
	break;

	case '0':
		stop_server($screen_name);
	break;
	
	default:
	break;
}