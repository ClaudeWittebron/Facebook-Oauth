<?php
    session_start();
    require_once('Facebook/autoload.php');

    $FB = new \Facebook\Facebook([
        'app_id'=>'163694204303451',
        'app_secret'=>'979a86af66e13051fe9512d999b1ced1',
        'default_graph_version' =>'v2.2'
    ]);

    $helper = $FB->getRedirectLoginHelper();
      
?>
<?php
    $redirectURL = "https://localhost/oauthclaude/fb-callback.php";
    $permissions = ['email','user_birthday','user_location','user_posts','user_friends','user_photos','user_tagged_places'];
    $loginURL = $helper->getLoginUrl($redirectURL,$permissions);
    //echo $loginURL; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.min.css">
    <style media="screen">
        #error{display: none;}
    </style>
</head>
<body background="bg2.jpg"style="background-position: right;background-repeat: no-repeat;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Welcome User</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav> 
<form action='index.php' method='POST' enctype='multipart/form-data' style="opacity:0.75;">
    <fieldset> 
      <div class='card border-dark mb-3' style='max-width: 22rem;margin:0 auto;'>
          <div class='card-header'>Sign In</div>
          <div class='card-body'>
              <h4 class='card-title'>Login with Credentials</h4>
              <p class='card-text'>You may use the above provided username and password for the login.</p>
  
              <div class='form-group'>
                <label for='exampleInputEmail1'>Email address</label>
                <input class='form-control' id='inputmail' name='inputmail' aria-describedby='emailHelp' placeholder='Enter email' type=' ' max-width: 20rem;>
                <small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else.</small>
              </div>
              <div class='form-group'>
                <label for='exampleInputPassword1'>Password</label>
                <input class='form-control' id='inputpassw' name='inputpassw' placeholder='Password' type='password' max-width: 20rem;>
              </div>
  
              <button name='submit' type='submit' class='btn btn-success'>Submit</button> </br>
              <a class="nav-link" style='margin:left;' href='<?php  echo $loginURL ?>'/><img src='fb.png'/> </a>
              <span id='error' class='badge badge-danger'>Please Input the Correct email and Password.</span>
              
          </div>
      </div>
    </fieldset>
</form>   
</body>
</html>