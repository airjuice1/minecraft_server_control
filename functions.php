<?php
function start_server($server_path = false, $screen_name = '', $delay = 20)
{
	shell_exec('echo START MINECRAFT SERVER\n');
	shell_exec('cd ' $server_path);
	shell_exec('screen -dmS ' . $screen_name . ' java -Xmx62G -jar server.jar --nogui');
	sleep($delay);
	shell_exec('echo MINECRAFT SERVER STARTED\n');
}

function stop_server($screen_name = '', $delay = 10)
{
	shell_exec('screen -S ' . $screen_name . ' -p 0 -X stuff "^C"');
	sleep($delay);
}