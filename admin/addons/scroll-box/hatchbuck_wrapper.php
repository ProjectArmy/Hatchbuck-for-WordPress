<?php
	function http_parse_headers ($raw) {
		$res = [];
		foreach (explode("\n", $raw) as $h) {
			$h = explode(':', $h, 2);
			$first = @trim($h[0]);
			$last = @trim($h[1]);
			
			if (array_key_exists($first, $res)) {
				$res[$first] .= ", " . $last;
			} else
			if (isset($h[1])) {
				$res[$first] = $last;
			} else {
				$res[] = $first;
			}
		}
		return $res;
	}

	
	function remote_post($url, $data){
		ini_set('default_socket_timeout', 10);
		$opts = array(        'http' => array(            'method'    =>"POST",            'timeout'   => 10,            'header'    =>  "Content-type: application/json\r\n" .                            "Content-Length: " .strlen($data) . "\r\n",            'content'      => $data,            'ignore_errors' => true        )    );
		$context = stream_context_create($opts);
		$result = file_get_contents($url, false, $context);
		$response['response'] = http_parse_headers(implode("\n",$http_response_header));
		$response['response_code'] = explode(' ', $http_response_header[0])[1];
		$response['body'] = $result;
		return $response;
	}

	function subscribe($opts, $email, $fname, $lname) {
        $api_key = $opts['api_key'];
        $tag_key = $opts['tag_key'];
        $tag_name = $opts['tag_name'];
        $api_url = "https://api.hatchbuck.com/api/v1/contact/";
               
		$data = array( 'emails' => array(array('address' => $email,'type'  => 'Work')),'status' => array('name' => 'Lead'));
		$data['firstName'] = $fname;
		$data['lastName'] = $lname;
		$data = json_encode($data);

        try {
            $result = remote_post($api_url . '?api_key='. $api_key, 
                $data                         
            );
		}
        catch (Exception $e) {
            return "Server error.";
        }
		
        if ($result['response_code'] == 200) {
			$result = json_decode($result['body']);
			$contactId  = $result->contactId;
            try {
                $result = remote_post(                            
                                $api_url . $contactId . '/Tags?api_key='. $api_key,
                                json_encode(
                                    array(array('name'=>$tag_name, 'id' => $tag_key)
                                    ))                       
                                    );
                }
            catch (Exception $e) {
                return "Server error.";
            }
			if ($result['response_code'] == 201) {
				return 1;
			} else {
				return "Fail to add tag.";
			}

		} else
		if ($result['response_code'] == 401)            {
			return "Invalid API Key";
		} else
		if ($result['response_code'] == 400)            {
			$result = json_decode($result['body']);
            return $result->Message;
            
		}

		return "Invalid response from server";
	}

    
    //$api_key = "TFdBaVV3....";
	//$tag_key = "bWZLZ1Ez....";
	//$tag_name = "Scroll Box";
	//$api_url = 'https://api.hatchbuck.com/api/v1/contact/';
	//var_dump(subscribe("scrollbox6@demo.com", "Scroll", "Box"));  // Return 1 if everything successfull
	?>