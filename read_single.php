<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');


//initializing the api
include_once('../healthCenterApp/principal.php');


//instantiate post

$post = new Post($db);

$post->id= isset($_GET['id']) ? $_GET['id'] : die();
$post->read_single();

$post_arr = array(
  'id' => $post ->id,
  'title' => $post ->title,
  'author' => $post ->author,
  'category_id' => $post ->category_id,
  'category_name' => $post ->category_name,

);

//make a json
print_r(json_encode($post_arr));




}





?>
