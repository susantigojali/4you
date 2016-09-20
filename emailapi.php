<?php
include_once "./library/OAuthStore.php";
include_once "./library/OAuthRequester.php";
 
define("CONSUMER_KEY", "bestapp160");
define("CONSUMER_SECRET", "SN48R");
define("OAUTH_HOST", "http://sandbox.appprime.net");
define("REQUEST_TOKEN_URL", OAUTH_HOST."/TemanDev/rest/RequestToken/");
define("ACCESS_TOKEN_URL", OAUTH_HOST."/TemanDev/rest/AccessToken/");
 
// Init the OAuthStore
$options = array(
'consumer_key' => CONSUMER_KEY,
'consumer_secret' => CONSUMER_SECRET,
'server_uri' => OAUTH_HOST,
'request_token_uri' => REQUEST_TOKEN_URL,
'access_token_uri' => ACCESS_TOKEN_URL
);
// Note: do not use "Session" storage in production. Prefer a database storage, such as MySQL.
OAuthStore::instance("Session", $options);
 
try
{
// STEP 1: If we do not have an OAuth token yet, go get one
$getAuthTokenParams = null;
// get a request token
echo 'fetch request token..';
$tokenResultParams = OAuthRequester::requestRequestToken(CONSUMER_KEY, 0, $getAuthTokenParams);
echo '<br>request token = '.$tokenResultParams["token"];
echo '<br>';
// STEP 2: Get an access token
try {
OAuthRequester::requestAccessToken(CONSUMER_KEY, $tokenResultParams["token"], 0, 'POST');
}
catch (OAuthException2 $e)
{
var_dump($e);
return;
}

	
 
 // make the docs request.
$urlAPI = OAUTH_HOST.'/TemanDev/rest/sendEmail/';
$opt = array(CURLOPT_HTTPHEADER=>array('Content-Type: application/json'));

$subject=$_POST['subject'];
$content=$_POST['content'];

	$con=mysqli_connect("127.0.0.1","root","","telefood");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT * FROM user");
	

while($row = mysqli_fetch_array($result))
{
	$body1 = '{"sendEmail":{"to":'.'"'.$row["email"].'"'.',"subject":';

	$body2 =',"content":'.'"'.$content.'"'.'}}';   

	$body = $body1.'"'.$subject.'"'.$body2;  


	echo '$body : '.$body;	
	
	$request = new OAuthRequester($urlAPI,'POST',$tokenResultParams,$body);
	echo 'execute api.. masuk sini ';
	$result = $request->doRequest(0,$opt);
	if ($result['code'] == 200) {
			echo $result['body'];
	}
	else {
			echo 'Error: '.$result['code'];
	}
}

  
$request = new OAuthRequester($urlAPI,'POST',$tokenResultParams,$body);
echo 'execute api.. masuk sini ';
$result = $request->doRequest(0,$opt);
if ($result['code'] == 200) {
        echo $result['body'];
}
else {
        echo 'Error: '.$result['code'];
}



}
catch(OAuthException2 $e) {
echo "OAuthException: " . $e->getMessage();
var_dump($e);
}
$ID = $_GET['id'];
header("location: index.php?id=".$ID);
?>