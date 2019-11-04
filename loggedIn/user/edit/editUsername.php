<?php 
   include_once '../../../connect/ConnDB.php';
session_start();
    $conn = connDB();
    $error = NULL;
echo var_dump($_SESSION['id']);
   /* if (isset($_POST['submit']))
    {
        $sqlcol = "SELECT * FROM `profiles`";
        $ind = 0;
        $newUsername = $_POST['name'];
        foreach($conn->query($sqlcol) as $row)
        {
            if ($row['name'] == $username or $row['email'] == $email)
            {
                echo '<script>alert("username)</script>';
                echo '<script>window.location="signup.php"</script>';
                $ind++;
            }
        }
        if ($ind == 0)
        {
            $id = $_SESSION['id'];
            $stmt = $conn->prepare("UPDATE profiles SET name = '$username' WHERE id = '$id' LIMIT 1");
            $stmt->bindParam('newUsername', $newUsername,PDO::PARAM_STR);
        }
    } */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>edit username</title>
        <link rel="stylesheet" href="../../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">
    
            </div>
        </nav>
        <form action="" method="post">
            <input class="input" type="text" minlength="5" title="username must contain at least 5 characters" placeholder="Enter new username" name="name" required>
            <input type="submit" name="submit" value="proceed">
        </form>
    </body>
</html>