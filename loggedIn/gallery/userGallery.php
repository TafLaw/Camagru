<?php
    include_once '../../config/ConnDB.php';
    session_start();
    $conn = connDB();
    $id = $_SESSION['id'];
    $userInfo = "SELECT * FROM profiles WHERE id = '$id' LIMIT 1";
    foreach($conn->query($userInfo) as $rows)
    {
        $user = $rows['name'];
    }
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
                <button onclick="window.location.href='../user/editProfile.php'">Edit profile</button>
                <button onclick="window.location.href='userGallery.php'">Uploads</button>          
            </div>
        </nav>
        <form  action="images/uploadPic.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">upload</button>
        </form>
        <hr>
        <h1 style="text-align: center">YOUR UPLOADS</h1>
        <?php
            $sql = "SELECT * FROM images WHERE user = '$user'";
            if($res = $conn->query($sql))
            {
                if ($res->fetchColumn() > 0)
                {
                    // echo "we will be here";
                    foreach($conn->query($sql) as $row)
                    {
                    ?>
                        <div id="block">
                            <form method="post" action="comments.php?user=<?php echo $user;?>&img=<?php echo $row["image"]?>">
                                <div align="center" id="images">
                                    <img src="images/<?php echo $row["image"]; ?>" width="150px" height="150px" alt="image"><div>
                                    <button type="submit" formaction="likes.php?user=<?php echo $user;?>&img=<?php echo $row["image"]?>">like</button></div>
                                    <input type="text" name="comment" placeholder="write your comment here">
                                    <button type="submit">comment</button>

                                </div>
                            </form>
                        </div>
                    <?php
                    }
                }
            }
            else 
                echo "failed\n";
        ?>
    </body>
</html>