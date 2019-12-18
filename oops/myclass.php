<?php
    //object oriented in php

    //make class with syntax: Class classname
    class Person{
        //attributes
        public $name;
        public $height;
        public $color;
        public $weight;
        public $gender;
        public $age;

        //constructor 
        function __construct($name,$height,$color,$weight,$gender,$age){
                echo" hey there i am at constructor <br>";
                $this->name= $name;
                $this->height= $height;
                $this->weight= $weight;
                $this->color= $color;
                $this->gender= $gender;
                $this->age= $age;
        }
        function __destruct(){
            echo "good bye see you tomorrow!!!<br>";
        }

        //methods
        // function set_name($name){
        //     $this->name= $name;
        // }
        function get_name(){
            return $this->name;
        }

        // function set_height($height){
        //     $this->height= $height;
        // }
        function get_height(){
            return $this->height;
        }
        // function set_color($color){
        //     $this->color= $color;
        // }
        function get_color(){
            return $this->color;
        }
        // function set_gender($gender){
        //     $this->gender= $gender;
        // }
        function get_gender(){
            return $this->gender;
        }
        function display(){
            echo "i am looking at you !!<br> ";
        }

       
    }

    class Animal{
        public $name;

        function Animal($p_name){
            $this->name= $p_name;
        }


    }
    // make object of type Person
    $p1 = new Person("Hari","180cm","white","60kg","male","30");
    $a1 = new Animal("cat");
    echo "hello its me {$a1->name} .how are you {$p1->name} ? <br>";

    echo $p1->display();
    // print_r($p1);
    // var_dump($p1);

    // $p1->set_name("Ram");
    // $p1->set_height(185);
    // $p1->set_color("Black");
    // $p1->set_gender("Male");

    echo "!!Wanted!! <br>";
    echo"Name: ". $p1->get_name()."<br>";
    echo"Height:". $p1->get_height()."<br>";
    echo"Color: ". $p1->get_color()."<br>";
    echo"Gender: ". $p1->get_gender()."<br>";

?>