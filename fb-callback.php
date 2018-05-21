<?php
    session_start();
    require_once('Facebook/autoload.php');
    $fb = new Facebook\Facebook([
      'app_id'=>'163694204303451',
      'app_secret'=>'979a86af66e13051fe9512d999b1ced1',
      'default_graph_version' => 'v2.2',
      ]);
    
    $helper = $fb->getRedirectLoginHelper();
    try {
      $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    if (!isset($accessToken)) {
      if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
      } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request Claudooo';
      }
      exit;
    }
    
    // Logged in
  echo '<h3>Access Token</h3>';
  var_dump($accessToken->getValue());

  // The OAuth 2.0 client handler helps us manage access tokens
  $oAuth2Client = $fb->getOAuth2Client();

  // Get the access token metadata from /debug_token
  $tokenMetadata = $oAuth2Client->debugToken($accessToken);
  echo '<h3>Metadata</h3>';
  var_dump($tokenMetadata);

  // Validation (these will throw FacebookSDKException's when they fail)
  $tokenMetadata->validateAppId('163694204303451'); // Replace {app-id} with your app id
  // If you know the user ID this access token belongs to, you can validate it here
  //$tokenMetadata->validateUserId('123');
  $tokenMetadata->validateExpiration();

  if (! $accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
      $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
      echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
      exit;
    }

    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
  }

  $_SESSION['fb_access_token'] = (string) $accessToken;

  // User is logged in with a long-lived access token.
  // You can redirect them to a members-only page.
  //header('Location: https://example.com/members.php');
  
  try {
      // Returns a `Facebook\FacebookResponse` object
      $response = $fb->get('me?fields=id,name,birthday,location,email,gender,short_name,albums,likes,posts,friends,tagged_places', (string) $accessToken);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    $userData =$response->getGraphnode()->asArray();
    $_SESSION['user'] = $response->getGraphnode();
    $_SESSION['userData'] = $userData;
    $_SESSION['access_token'] =(string) $accessToken;
    header('Location:process.php');
    
  /* 
    $user = $response->getGraphUser();
    echo '<br/>';
    echo 'Name: ' . $user['name'];
    echo '<br/>';
    echo 'Name: ' . $user['short_name'];
    global $user;
    echo"<a href='process.php'>click me</a>";
    echo '<br/>';
    echo $_SESSION['fb_access_token'];
  */
  exit();
  ?>

