<!DOCTYPE html>
<html>
<body>

<?php
class Fruit {
  public $name;
  public $color;
  public function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color; 
  }
  protected function intro() {
    echo "The fruit is {$this->name} and the color is {$this->color}."; 
  }
}

class Strawberry extends Fruit {
  public function message() {
    echo "Am I a fruit or a berry? ";
    // Call protected function from within derived class - OK 
    $this -> intro();
  }
// //overriding
//   public function intro() {
//     echo "The fruit is {$this->name}, the color is {$this->color}, and the weight is {$this->weight} gram.";
//   }
}
$strawberry = new Strawberry("Strawberry", "red");  // OK. __construct() is public
$strawberry->message(); // OK. message() is public and it calls intro() (which is protected) from within the derived class
$strawberry->intro(); // ERROR. intro() is protected

?>
 
</body>
</html>