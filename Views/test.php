<?php 
/* 
| Developed by: Tauseef Ahmad
| Last Upate: 01-19-2021 08:45 PM
| Facebook: www.facebook.com/ahmadlogs
| Twitter: www.twitter.com/ahmadlogs
| YouTube: https://www.youtube.com/channel/UCOXYfOHgu-C-UfGyDcu5sYw/
| Blog: https://ahmadlogs.wordpress.com/
 */ 
 
 

$arr['topic'] = "TEST CONFERENCIA";
$arr['start_date']= date("2022-05-16 00:30:00");
$arr['duration'] = 30;
$arr['password']= "venguapa";
$arr['type'] = "2";
$result = createMeeting($arr);
if(isset($result->id)){
        echo "Join URL".$result->join_url."<br>";
        echo "Join URL".$result->password."<br>";
        

}

 die();
$data = array();
$data['topic'] 		= 'Example Test Meeting';
$data['start_date'] = date("Y-m-d h:i:s", strtotime('tomorrow'));
$data['duration'] 	= 30;
$data['type'] 		= 2;
$data['password'] 	= "12345";

try {
	$response = $zoom_meeting->createMeeting($data);
	var_dump($response);
	//echo "<pre>";
	//print_r($response);
	//echo "<pre>";
	
	echo "Meeting ID: ". $response->id;
	echo "<br>";
	echo "Topic: "	. $response->topic;
	echo "<br>";
	echo "Join URL: ". $response->join_url ."<a href='". $response->join_url ."'>Open URL</a>";
	echo "<br>";
	echo "Meeting Password: ". $response->password;
    
	
} catch (Exception $ex) {
    echo $ex;
}


?>