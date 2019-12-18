<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register </title>
</head>
<body>
    <?php
        $errfirstname="";
        $errlastname="";
        $errusername="";
        $errpassword="";
        $erremail="";
        $firstname=$middelname="";

       if(isset($_POST['submit'])){
            $firstname = validate_input($_POST['firstname']);
            $middelname = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $photo = $_POST['photo'];
            echo $photo;

            $flength = strlen($firstname);
            $plength = strlen($password);
            if(empty($firstname)|| $flength <3 ){
               $errfirstname = "Ohh hello First name is required and must be greater than 3 character!!"; 
            }
            if(empty($lastname))
            {
                $errlastname = "Ohh hello Last name is required."; 
             }if(empty($email))
             {
                $erremail = "Ohh hello email name is required."; 
             }if(empty($username))
             {
                $errusername = "Ohh hello username is required."; 
             }if(empty($password)|| $plength <6 )
             {
                $errpassword = "Ohh hello password is required and should be greater than 6 character"; 
             }
        }

        function validate_input($data) {
            echo $data;
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

    ?>
    <style>
        #error{
            color:red;
        }
    </style>
    
    <div class="">
    <center>
    <h1>Registration form</h1>
      
        <p id="error">** are requried </p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" encypt="multipart/form-data" >
         
            <label for="firstname" name="firstname">Firstname</label>
            <input type="text" name="firstname" placeholder="Enter firstname here" ><sup id="error">**</sup> <span>must be atleast 3 character</span> 
            <div>
                <span id="error"><?php echo $errfirstname?></span>
            </div>
            <br>
            <br>
            <label for="middlename" >MiddleName</label>
            <input type="text"name="middlename" placeholder="Enter middle name here">

            <br><br>
            <label for="lastname" >lastname</label>
            <input type="text"name="lastname" placeholder="Enter last name here" required>
            <br><br>
            <label for="gender">Select Gender</label>
            <input type="radio" name="gender" checked>Male
            <input type="radio" name="gender">Female
            <br><br>
            <label for="email" name="email">Email</label>
            <input type="email" name="email">
            <br><br>
            <label for="username">UserName</label>
            <input type="text" name="username" placeholder= "Enter your username">
            <br><br>
            <label for="password">Password</label>
            <input type="password" name="password" >            
            <br><br>
            <label for="photo">Upload Photo</label>
            <input type="file" name="photo" >
            <br><br>
            <input type="submit" name="submit">
            <input type="reset" name="reset" id="reset">
        </form>
        <?php echo $firstname ?>
    </center>
    </div>
</body>
</html>