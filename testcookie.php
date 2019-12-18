<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="cookie_name">
        <input type="submit" name="submit">
    </form>

    <?php
        $c ="";
        $cookie_name = 'mycookie';
        if(isset($_POST['submit'])){
            $c = $_POST['cookie_name'];
            setcookie($cookie_name,$c);
        }
        if(count($_COOKIE)>0 && isset($_COOKIE[$cookie_name])){
            $cookie_value = $_COOKIE[$cookie_name];
            echo "my cookie is ".$cookie_value;
        }else{
            echo "cookie is not set";
        }
    ?>
            


</body>
</html>