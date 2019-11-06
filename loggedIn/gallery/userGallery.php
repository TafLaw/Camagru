<?php
    include_once '../../config/ConnDB.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>edit username</title>
        <link rel="stylesheet" href="../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button onclick="window.location.href='../../authenticate/login_signup/logout.php'">log out</button>
                <button onclick="window.location.href='editProfile.php'">Edit profile</button>
                <button onclick="window.location.href='../gallery/userGallery.php'">Uploads</button>          
            </div>
        </nav>
        <form class="uGallery" action="" method="post">
            <input type="file" name="file">
            <button type="submit" name="submit">upload</button>
        </form>
        <hr>
        <h1 style="text-align: center">YOUR UPLOADS</h1>
        <?php
        $query = "SELECT * FROM products ORDER BY id ASC";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                ?>
                <div style="width: 40%; box-shadow: 4px 4px 22px gray;" id="block">
                    <form method="post" action="./application/items/basket.php?action=add&id=<?php echo $row["id"]; ?>">
                        <div align="center" id="images">
                            <img src="<?php echo $row["image"]; ?>" alt="image">
                            <button type="submit" formaction="#">like</button>
                        </div>
                    </form>
                </div>
                <?php
            }
        }
    else 
    echo "failed\n";
    ?>
    </body>
</html>