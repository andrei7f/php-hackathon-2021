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
      ORDER BY p.created DESC';

    /*prepare statements */

    $stmt= $this->conn->prepare($query);
    //execute query
    $stmt->execute();

   return $stmt;
}
public function read_single(){
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
      WHERE p.id= ? LIMIT 1';

      /*prepare statements */

      $stmt= $this->conn->prepare($query);
      // binding param
      $stmt->bindParam(1,$this->id);
      //execute query
      $stmt->execute();
      $row =$stmt->fetch(PDO::FETCH_ASSOC);

      $this->title = $row['title'];
      $this->body = $row['body'];
      $this->author = $row['author'];
      $this->category_id = $row['category_id'];
      $this->category_name = $row['category_name'];

}
public function create(){
  //create query
  $query = 'INSERT INTO' . $this->table . 'SET title = :title, body = :body, author = :author,category_id = :category_id ';
  //prepare statement
  $stmt = $this->conn->prepare($query);
  //clean data
  $this->title        = htmlspecialchars(strip_tags($this->title));
  $this->body         = htmlspecialchars(strip_tags($this->body));
  $this->author       = htmlspecialchars(strip_tags($this->author));
  $this->category_id  = htmlspecialchars(strip_tags($this->category_id));

//binding of parameters
$stmt->bindParam('title',$this->title);
$stmt->bindParam('body',$this->body);
$stmt->bindParam('author',$this->author);
$stmt->bindParam('category_id',$this->category_id);

//execute the query
if($stmt->execute()){
  return true;
}
printf("Error  %s . \n,$stmt->error");
return false;

}

//delete function
public function delete(){
  //create query
  $query = 'DELETE FROM' . $this->table . 'WHERE id = :id';
  //prepare statement
  $stmt = $this->conn->prepare($query);
  //clean the data
   $this->id = htmlspecialchars(strip_tags($this->id));
   //binding the id parameter
    $stmt ->bindParam(':id', $this->id);
  //execute the query
    if($stmt->execute()){
      return true;
    }
    printf("Error  %s . \n,$stmt->error");
    return false;

}


?>

