<?php
require_once __DIR__ . '/config.php';
require __DIR__ . '/MinecraftPing.php';
require __DIR__ . '/MinecraftPingException.php';

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

try
{
	$Query = new MinecraftPing( $server_addr, $server_port );
	
	print_r( $Query->Query() );
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
