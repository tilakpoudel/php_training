<?php
echo "we are learning oop!! <br>";
class Shape
{

    public $name;
    public $breadth;
    public $length;
    public $height;
    protected $myfriend;

    public function set_values($my_name, $my_breadth, $my_length, $my_height, $my_friend)
    {
        $this->name = $my_name;
        $this->breadth = $my_breadth;
        $this->length = $my_length;
        $this->height = $my_height;
        $this->myfriend = $my_friend;
    }
    public function display()
    {
        echo "hello i am here to display some values <br>";
        echo "-------------------<br> ";
        echo " i am $this->name with length $this->length ,breadth $this->breadth, height $this->height and iam here with my friend $this->myfriend <br>";
    }

    private function my_private_function()
    {
        echo "hello i am private fucntion";
    }
    protected function my_protected_fucntion()
    {
        echo "hello its me protected fucntion";
    }
}
$s1 = new Shape();

$s1->set_values("Rectangle", 20, 30, 10, "square");
$s1->display();
    // $s1->myfriend="test ";
