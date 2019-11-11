<?php
    include_once '../../config/ConnDB.php';
    session_start();
    $conn = connDB();
    $id = $_SESSION['id'];
    $userInfo = "SELECT * FROM profiles WHERE id = '$id' LIMIT 1";
    if (!$_SESSION['id'])
        header('location: ../../authenticate/login_signup/signin_up.php');
    foreach($conn->query($userInfo) as $rows)
    {
        $user = $rows['id'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Camagru</title>
        <link rel="stylesheet" href="../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button class="nav_btn" onclick="window.location.href='../../authenticate/login_signup/logout.php'">log out</button>
                <button class="nav_btn" onclick="window.location.href='../user/editProfile.php'">Edit profile</button>
                <button class="nav_btn" onclick="window.location.href='userGallery.php'">Uploads</button>          
                <button class="nav_btn" onclick="window.location.href='publicGallery.php'">Gallery</button>          
            </div>
        </nav>
        <div id="galleryUpload">
            <form  action="images/uploadPic.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">upload</button>
            </form>
            <a href="../user/capture.php"><img class="webcamAcc" src="../../icons/camera.png"></a>
        </div>
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
                                    <button type="submit" formaction="delete.php?user=<?php echo $user;?>&img=<?php echo $row["image"]?>">delete</button></div>
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
    <footer>
            <hr>
            &copy; <i>tmuzeren 2019</i>
    </footer>
</html>