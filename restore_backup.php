<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

stop_server($screen_name);
restore_backup($server_path);
start_server($server_path, $screen_name);
