<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
require __DIR__ . '/MinecraftPing.php';
require __DIR__ . '/MinecraftPingException.php';

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

// screen -S minecraft_server -p 0 -X stuff "^C" && tar -czvf /home/juice/' . time() . 'backup_minecraft_server.tar.gz /servers/minecraft/vanilla && /servers/minecraft/vanilla/start.sh

try
{
	$Query = new MinecraftPing( $server_addr, $server_port );
	
	$result = $Query->Query();

	// echo 'try';

	if ((int)$result['players']['online'] == 0)
	{
		// echo 'stop';
		stop_server($screen_name);
	}
}
catch( MinecraftPingException $e )
{
	// echo $e->getMessage();	

	echo 'except';
	start_server($server_path, $screen_name);
}
finally
{
	echo 'finally';
	if( $Query )
	{
		$Query->Close();
	}
}
?>
