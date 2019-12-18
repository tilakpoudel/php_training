<!DOCTYPE html>
<?php
// Start the session
session_start();
$cookie_name = "user";
$cookie_value = "Tilak Poudel";

// setcookie(name, value, expire, path, domain, secure, httponly);

setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<html>
<body>

<?php

// Set session variables
$_SESSION["favcolor"] = "red";
$_SESSION["favanimal"] = "dog";
echo "Session variables are set.<br>";

if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
} else {
    echo "Cookies are disabled.";
}

if(!isset($_COOKIE[$cookie_name])) {
     echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
     echo "Cookie '" . $cookie_name . "' is set!<br>";
     echo "Value is: " . $_COOKIE[$cookie_name];
}
?>

<p><strong>Note:</strong> You might have to reload the page to see the new value of the cookie.</p>

</body>
</html>