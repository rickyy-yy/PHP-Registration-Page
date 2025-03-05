<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registration Page</h1>
    <br>
    <form action="index.php" method="POST">
        <table>
            <tr>
                <td><label>Username</label></td>
                <td>: </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td><label>Password</label></td>
                <td>: </td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="register" value="Join Us!"></td>
            </tr>
        </table>
    </form>
    <hr>
    <button><a href="login.php" style="text-decoration: none; color: black;">Login</button>
</body>
</html>

<?php
    if (isset($_POST["register"])){
        if (strlen($_POST["username"]) <= 6){
            echo "<p style='color: red;'>Username is too short! Must be at least 7 characters.</p>";
        }
        else{
            $clean_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);

            if (strlen($_POST["password"]) <= 7){
                echo "<p style='color: red;'>Password is too short! Must be at least 8 characters.</p>";
            }
            else{
                $clean_password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
                $hash_password = password_hash($clean_password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password) VALUES ('$clean_username', '$hash_password')";
                mysqli_query($conn, $sql);
            }
        }
    }
?>