<?php
namespace juju\curl;

class Curl
{
	public function get($url,$referer = '')
	{
		//判断curl是否存在
		$result = function_exists('curl_init');

		if($result)
		{
			$ch = curl_init();    
		    $timeout = 60;
		    curl_setopt ($ch, CURLOPT_URL, $url);    
		    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); 
		    curl_setopt ($ch, CURLOPT_REFERER, $referer); 
		    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);    
		    $str = curl_exec($ch);    
		    curl_close($ch);

		}else{
			$str = file_get_contents($url);
		}

	    return $str; 
	}

	public function post($url,$post_data)
	{
		$result = function_exists('curl_init');

		if($result)
		{
			$ch = curl_init();    
		    $timeout = 60;
		    curl_setopt ($ch, CURLOPT_URL, $url);
		    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt ($ch, CURLOPT_POST, 1);
		    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_data);//
		    $str = curl_exec($ch);    
		    curl_close($ch);
		}else{
			$data = http_build_query($post_data);  
			$opts = array(  
				'http'=>array(  
					'method'=>"POST",  
					'header'=>"Content-type: application/x-www-form-urlencoded\r\n".  
					"Content-length:".strlen($data)."\r\n" .   
					"Cookie: foo=bar\r\n" .   
					"\r\n",  
					'content' => $data,  
				)  
			);  
			$cxContext = stream_context_create($opts);  
			$str = file_get_contents($url, false, $cxContext);
		}
		
	    return $str; 
	}
}