<?php


print_r($_POST);
echo "</br></br>";
print_r(["test" => "test", "test2" => "test2"]);

?>

<form action="" method="post">
    <input type="text" name="username" placeholder="Enter username">
    <input type="password" name="password" placeholder="Enter password">
    <button type="submit" name="loginUserForm">Login</button>
</form>