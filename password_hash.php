<?php
$password = "adminpassword123"; 
$password1 = "approver1password"; 
$password2 = "approver2password";

echo "Hash untuk admin: " . password_hash($password, PASSWORD_BCRYPT) . "<br>";
echo "Hash untuk approver1: " . password_hash($password1, PASSWORD_BCRYPT) . "<br>";
echo "Hash untuk approver2: " . password_hash($password2, PASSWORD_BCRYPT) . "<br>";
?>
