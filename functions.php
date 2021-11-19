<?php
function start_server($server_path = false, $screen_name = '', $delay = 10)
{
	system('echo START MINECRAFT SERVER' . "\n");		
	system('cd ' . $server_path  . ' && screen -dmS ' . $screen_name . ' java -Xmx62G -jar server.jar --nogui');
	sleep($delay);
	system('echo MINECRAFT SERVER STARTED' . "\n");
}

function stop_server($screen_name = '', $delay = 10)
{
	system('screen -S ' . $screen_name . ' -p 0 -X stuff "^C"');
	sleep($delay);
}