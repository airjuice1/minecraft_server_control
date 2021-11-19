<?php
function start_server($server_path = false, $screen_name = '', $delay = 10)
{
	if ( ! find_session_name($screen_name) )
	{
		system('echo START MINECRAFT SERVER' . "\n");		
		system('cd ' . $server_path  . ' && screen -dmS ' . $screen_name . ' java -Xmx62G -jar server.jar --nogui');
		sleep($delay);
		system('echo MINECRAFT SERVER STARTED' . "\n");
	}
}

function stop_server($screen_name = '', $delay = 10)
{
	system('screen -S ' . $screen_name . ' -p 0 -X stuff "^C"');
	sleep($delay);
}

function make_archive($target_path = '', $out_path = '/home/juice/', $screen_name = '', $delay = 20)
{
	system('screen -S ' . $screen_name . ' -p 0 -X stuff "/save-all"');
	system('screen -S ' . $screen_name . ' -p 0 -X stuff "^M"');
	system('tar -czvf ' . $out_path . time() . 'backup_minecraft_server.tar.gz ' . $target_path);
	sleep($delay);
}

function remove_archives($path = '/home/juice/')
{
	system('rm -rf ' . $path . '*.tar.gz');
}

function restore_backup($server_path = '', $backup_path = '~')
{
	$backup_filename = trim(shell_exec('ls -dt ' . $backup_path . '/*_minecraft_server.tar.gz | head -1'));
	system('tar -xvzf ' . $backup_filename . ' -C /tmp');
	system('rm -rf ' . $server_path . '*');
	sleep(5);
	system('cp -R /tmp' . $server_path . '/* ' . $server_path);
	sleep(5);
	system('rm -rf /tmp/servers/');
	system('rm -rf /tmp/*_minecraft_server.tar.gz');
	system('rm -rf '. $backup_path . '/*_minecraft_server.tar.gz');
}

function find_session_name($target = '')
{
	$result = false;
	$output = shell_exec('screen -ls');	
	
	if (mb_strpos($output, $target) !== false)
	{
		$result = true;
	}

	return $result;
}

