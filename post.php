<?php

class Post{
  //db stuff
 private $conn;
 private $table = 'posts';


 //post properties
 public $id;
 public $category_id;
 public $category_name;
 public $title;
 public $body;
 public $author;
 public $create_at;    // the date when the programm starts
 public $room;         // the room where the action take place
 public $end_at;       // the date that the user finishies the programm
 public $CNP;          // CNP of the user for identification

 //constructor with db connection
public function __construct($db){
  $this->conn = $db;

  }

//getting posts from our database
public function read(){
  //create query
  $query = 'SELECT
  c.name as category_name,
  p.id,
  p.category_id,
  p.title,
  p.body,
  p.author,
  p.create_at,
  p.end_at,
  p.room,
  p.CNP,
  FROM
  ' .$this->table . ' p
   LEFT JOIN
      categories c ON p.category_id = c.id
      ORDERED BY p.created DESC';

    /*prepare statements */

    $stmt= $this->conn->prepare($query);
    //execute query
    $stmt->execute();

   return $stmt;



}

}


?>
