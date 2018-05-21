<?php
    error_reporting(0);
    @ini_set('display_errors', 0);
    session_start();
    require_once('config.php');
    //var_dump($_SESSION['userData']);
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
</head>
<body background="bg1.jpg"style="background-position: right;background-repeat: no-repeat;background-attachment: fixed;background-size:cover;">
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
    <form action='logout.php'class="form-inline my-2 my-lg-0">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Logout</button>
    </form>
  </div>
</nav> 
<div class="card border-dark mb-3" style="max-width: 40rem;float:left;display: inline-block;opacity:0.75    ;">
  <div class="card-header">User Basic Details</div>
  <div class="card-body">
    <h4 class="card-title">Hello, <?php echo $_SESSION['userData']['name'];?></h4>
    <p class="card-text">Welcome to the User Analyzer. This is your analysis report according to the behaviour of facebook.</p>
    <div class="card-body">
        <h4 class="card-title"></h4>
        <p class="card-text"></p>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Type</th>
            <th scope="col">Information</th>
        
            </tr>
        </thead>
        <tbody>
            <tr class="table-active">
                <th scope="row">Identity</th>
                <td><?php echo $_SESSION['userData']['id'];?></td>
            </tr>
            <tr>
                <th scope="row">Name</th>
                <td><?php echo $_SESSION['userData']['name'];?></td>
            </tr>
            <tr class="table-secondary">
                <th scope="row">Location</th>
                <td><?php echo $_SESSION['userData']['location']['name'];?></td>
            </tr>
            <tr>
                <th scope="row">Gender</th>
                <td><?php echo  ucfirst($_SESSION['userData']['gender']);?></td>
            </tr>
            <tr class="table-primary">
                <th scope="row">Email</th>
                <td><?php echo $_SESSION['userData']['email'];?></td>
            </tr>
        </tbody>
        </table> 
  </div>
</div>
&nbsp
<div class="card border-info mb-3" style="max-width: 52rem;float:top;display: inline-block;opacity:0.75;">
  <div class="card-header">Posts</div>
  <div class="card-body">
    <h4 class="card-title">Recent Posts with Interests</h4>
    <p class="card-text"><?php echo alignPosts();?></p>
  </div>
</div>
&nbsp
<div class="card border-success mb-3" style="max-width: 40rem;opacity:0.75;">
  <div class="card-header">Tags</div>
  <div class="card-body">
    <h4 class="card-title">Recent Tagged Locations</h4>
    <p class="card-text"><?php echo alignTags();?></p>
  </div>
</div>
&nbsp &nbsp &nbsp

</body>
</html>

<?php
    function alignPosts(){
        error_reporting(0);
        @ini_set('display_errors', 0);
        $vali = get_user_posts($_SESSION['access_token']);
        $json = json_decode($vali);
        //echo $vali;
        for($i=0; $i<=20; $i++)
        {
            if(isset($json->posts->data[$i]->message))
            {
                echo '<p class="alert alert-dismissible alert-primary">';
                echo $json->posts->data[$i]->message; 
                echo "<br/>";
                echo "Time Created : ".$json->posts->data[$i]->created_time;
                echo "</p>";
                echo "<br/>";
            }
            
        }
    }

    function alignFriends(){
        error_reporting(0);
        @ini_set('display_errors', 0);
        $vali = get_user_friends($_SESSION['access_token']);
        $json = json_decode($vali);
        //echo $vali;
        for($i=0; $i<=20; $i++)
        {
            if(isset($json->friends->data[$i]->name))
            {
                echo '<p class="alert alert-dismissible alert-warning">';
                echo $json->friends->data[$i]->name; 
                echo "<br/>";
                echo "ID : ".$json->friends->data[$i]->id;
                echo "</p>";
                echo "<br/>";
            }
            
        }
    }

    function alignTags(){
        error_reporting(0);
        @ini_set('display_errors', 0);
        $vali = get_user_tags($_SESSION['access_token']);
        $json = json_decode($vali);
        //echo $vali;
        //echo $json->tagged_places->data[$i]->place->name;
        for($i=0; $i<=20; $i++)
        {
            if(isset($json->tagged_places->data[$i]->place->name))
            {
                echo '<p class="alert alert-dismissible alert-success">';
                echo "Name Tagged: &nbsp".$json->tagged_places->data[$i]->place->name."</br>";
                echo "Street: &nbsp".$json->tagged_places->data[$i]->place->location->street."</br>";
                echo "City: &nbsp".$json->tagged_places->data[$i]->place->location->city."</br>"; 
                echo "Country: &nbsp".$json->tagged_places->data[$i]->place->location->country."</br>";
                echo "<br/>";
                echo "Time Created : ".$json->tagged_places->data[$i]->created_time;
                echo "</p>";
                echo "<br/>";
            }
            
        }
    }
?>