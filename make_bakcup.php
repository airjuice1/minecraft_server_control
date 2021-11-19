<?php
require_once __DIR__ . '/config.php';
require __DIR__ . '/MinecraftPing.php';
require __DIR__ . '/MinecraftPingException.php';

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

// screen -S minecraft_server -p 0 -X stuff "^C" && tar -czvf /home/juice/' . time() . 'backup_minecraft_server.tar.gz /servers/minecraft/vanilla && /servers/minecraft/vanilla/start.sh

try
{
	$Query = new MinecraftPing( $server_addr, $server_port );
	
	$result = $Query->Query();

	if ((int)$result['players']['online'] == 0)
	{
		// system('screen -S ' . $screen_name . ' -p 0 -X stuff "^C"');
		system('screen -S ' . $screen_name . ' -p 0 -X stuff "^C"');
	}
}
catch( MinecraftPingException $e )
{
	echo $e->getMessage();
}
finally
{
	if( $Query )
	{
		$Query->Close();
	}
}
?>
