<?php 

class User {
  public $id;
  public $name;
  public $email;

  function __construct($id, $name, $email)
  {
      $this->id = $id;
      $this->name = $name;
      $this->email = $email;
  }
}

$users = array();

if(isset($_GET['getUsers-btn'])) {
    // get users from the database
    $result = $connection->query("SELECT * FROM users ORDER BY id");
    while ($row = $result->fetch_assoc()) {
      $users[] = new User($row["id"], $row["name"], $row["email"]);
    }
}
?>