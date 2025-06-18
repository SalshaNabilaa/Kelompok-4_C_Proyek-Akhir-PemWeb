<?php
$password_hash = password_hash(password:"admin123", algo:PASSWORD_DEFAULT);

echo $password_hash;
?>