<?php 
        // create curl resource 
        #$ch = curl_init(); 

        // set url 
       # curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/ss_administrator/index.php?request=5425ff73-a599-4751-8759-7e170e730717/auth/eeeyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiIiwicmVxdWVzdCI6InRva2VuIiwibmFtZSI6ImFkbWluIn0.aa994bece22a4f2cdb43803039d762c83f7a6d07530abfb55df1a2a0dd9ac2fa");#2fa 

        //return the transfer as a string 
       # curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        #$output = curl_exec($ch); 
		#echo json_decode($output,true);
		#echo 'check';
		
        // close curl resource to free up system resources 
       # curl_close($ch);
		#echo $output;
		#echo '-----';
		#print_r($output);
		#$num = json_decode($output,true);
		#echo $num;
		#echo '-----';
		#$num = json_decode($num,true);
		#echo gettype($num);
		#print_r($num);
		##echo $num['token'];
		
		include('common.php');
		$url = 'http://127.0.0.1/ss_administrator/index.php?request=5425ff73-a599-4751-8759-7e170e730717/auth/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiIiwicmVxdWVzdCI6InRva2VuIiwibmFtZSI6ImFkbWluIn0.aa994bece22a4f2cdb43803039d762c83f7a6d07530abfb55df1a2a0dd9ac2fa';
		
		$result = curl_request($url,'GET');
		$result = json_decode($result,true);
		$result = json_decode($result,true);
		print_r($result);
?>