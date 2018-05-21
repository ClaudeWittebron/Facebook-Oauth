<?php
function get_user_posts($access_token){
    $parameters = array('fields'=>'id');
    $buildParam = http_build_query($parameters);
    $requestContent = array('method'=>'GET','header'=>'Authorization:Bearer '.$access_token,'content'=>$buildParam);
    $reqcontex = stream_context_create(array('http'=>$requestContent));
    $result = file_get_contents('https://graph.facebook.com/v3.0/'.$_SESSION['userData']['id'].'?fields=posts',false,$reqcontex);
    return $result;
}

function get_user_friends($access_token)
{
    $parameters = array('fields'=>'id');
    $buildParam = http_build_query($parameters);
    $requestContent = array('method'=>'GET','header'=>'Authorization:Bearer '.$access_token,'content'=>$buildParam);
    $reqcontex = stream_context_create(array('http'=>$requestContent));
    $result = file_get_contents('https://graph.facebook.com/v3.0/'.$_SESSION['userData']['id'].'?fields=friends',false,$reqcontex);
    return $result;
}

function get_user_tags($access_token){
    $parameters = array('fields'=>'id');
    $buildParam = http_build_query($parameters);
    $requestContent = array('method'=>'GET','header'=>'Authorization:Bearer '.$access_token,'content'=>$buildParam);
    $reqcontex = stream_context_create(array('http'=>$requestContent));
    $result = file_get_contents('https://graph.facebook.com/v3.0/'.$_SESSION['userData']['id'].'?fields=tagged_places',false,$reqcontex);
    return $result;
}



?>