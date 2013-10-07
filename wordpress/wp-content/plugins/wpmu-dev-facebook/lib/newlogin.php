<?php
	
	require 'libs/facebook.php';
	$cnn = mysql_connect('localhost', 'lpeduca_wp', 'zaq1xsw2cde3');
	$sdb = mysql_select_db('lpeduca_wordpress', $cnn);

	$config = array();
	$config['appId'] = '451937241580711';
	$config['secret'] = 'f765a8956d73cf2f2af158ff68e0581f';

	// Init the Facebook SDK
       $facebook = new Facebook(array(
         'appId'  => $config['appId'],
         'secret' => $config['secret'],
       ));

       $access_token = $facebook->getAccessToken();

        // Get the current user
       $user = $facebook->getUser();

       // If the user has not installed the app, redirect them to the Login Dialog

       if (!$user) {
         $loginUrl = $facebook->getLoginUrl(array(
           'display' => 'popup',
           'scope' => $scope,
           'redirect_uri' => 'http://google.com',
         ));

         print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
       }

   	$check = mysql_query("SELECT * FROM wp_signups WHERE user_login = '$user'");
   	$conta = mysql_num_rows($check);

   	if ($conta == 0) {
   		print('<iframe src="http://www.facebook.com/plugins/registration.php?fb_only=true&amp;client_id=451937241580711&amp;redirect_uri=http%3A%2F%2Fwww.lp-educacional.com.br%2Fwp-signup.php%3Faction%3Dregister%26fb_register%3D1&amp;locale=pt_PT"');

   	} else {
   		
   	}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <title></title>
  <!-- Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. -->
  <!--[if lt IE 9]>
  <script src="js/html5.js" type="text/javascript"></script>
  <![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <meta name="author" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="google-site-verification" content="">
</head>
<body>

  
</body>
</html>



