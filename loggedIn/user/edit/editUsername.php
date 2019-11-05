<?php 
    include_once '../../../connect/ConnDB.php';
    session_start();
    $conn = connDB();

   if (isset($_POST['submit']))
    {
        if (isset($_SESSION['id']))
        {
            $sqlcol = "SELECT * FROM `profiles`";
            $ind = 0;
            $newUsername = $_POST['name'];
            $id = $_SESSION['id'];
            
            foreach($conn->query($sqlcol) as $row)
            {
                if ($row['name'] == $newUsername)
                {
                    echo '<script>alert("username already in use")</script>';
                    echo '<script>window.location="editUsername.php"</script>';
                    $ind++;
                }
            }
            if ($ind == 0)
            {
                $stmt = $conn->prepare("UPDATE profiles SET name = '$newUsername' WHERE id = '$id' LIMIT 1");
                $stmt->bindParam('newUsername', $newUsername,PDO::PARAM_STR);
                $stmt->execute();
            }
        }
        else
            echo "session not set";
    }
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
                <button onclick="window.location.href='../../../authenticate/login_signup/logout.php'">log out</button>            
            </div>
        </nav>
        <form action="" method="post">
            <input id = "newUn" type="text" minlength="5" title="username must contain at least 5 characters" placeholder="Enter new username" name="name" required>
            <input type="submit" name="submit" value="proceed">
        </form>
    </body>
</html>