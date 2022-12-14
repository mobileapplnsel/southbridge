<?php 
	if(!function_exists('verifyAuthToken'))
	{
		function verifyAuthToken($token)
		{
			$jwt            = new JWT();
        	$jwtsecretkey   = 'hellokolkatakey';
        	$verificaion    = $jwt->decode($token,$jwtsecretkey,'HS256');

        	return $verificaion_json = $jwt->jsonEncode($verificaion);
		}
	}	
?>