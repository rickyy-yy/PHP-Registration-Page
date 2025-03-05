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
    <h1>Login Page</h1>
    <br>
    <form action="login.php" method="POST">
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
                <td><input type="submit" name="login" value="Log In!"></td>
            </tr>
        </table>
    </form>
    <hr>
    <button><a href="index.php" style="text-decoration: none; color: black;">Register</button>
</body>
</html>

<?php
    if (isset($_POST["login"])){
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

                $sql = "SELECT * FROM users WHERE username = '$clean_username';";
                $results = mysqli_query($conn, $sql);

                if (mysqli_num_rows($results) > 0){
                    $account = mysqli_fetch_assoc($results);
                    $hashed_password = $account["password"];

                    if (password_verify($clean_password, $hashed_password)){
                        echo "Log in successful.";
                    }
                    else{
                        echo "Username/Password is incorrect.";
                    }
                }
                else{
                    echo "Username/Password is incorrect.";
                }
            }
        }
    }
?>