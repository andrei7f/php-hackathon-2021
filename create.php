<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Acces-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers:Acces-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methods,Authorization,X-Requested-With');

//initializing the api
include_once('../healthCenterApp/principal.php');


//instantiate post

$post = new Post($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$post->title = $ data->title;
$post->imap_bodystruct = $ data->body;
$post->author = $ data->author;
$post->category_id = $ data->category_id;

//create post
if($post->create()){
  echo json_encode(
    array('message'=> 'Post created.')
  );
}else
echo json_encode(
  array('message'=> 'Post not created.')
);





}





?>
