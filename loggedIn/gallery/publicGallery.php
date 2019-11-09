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
                <?php 
                if (!$_SESSION['id'])
                {?>
                    <button onclick="window.location.href='../../authenticate/login_signup/signin_up.php'">login</button>
                    <button onclick="window.location.href='../../authenticate/login_signup/signup.php'">sign up</button>
                <?php
                }
                else
                {?>
                <button onclick="window.location.href='../../authenticate/login_signup/logout.php'">log out</button>
                <button onclick="window.location.href='../user/editProfile.php'">Edit profile</button>
                <button onclick="window.location.href='userGallery.php'">Uploads</button>          
                <button onclick="window.location.href='publicGallery.php'">Gallery</button>
                <?php
                }?>
            </div>
        </nav>
        <!-- <form  action="images/uploadPic.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">upload</button>
        </form> -->
        <hr>
        <h1 style="text-align: center">Gallery</h1>
        <?php
            $sql = "SELECT * FROM images";
            $liked = 0;
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
                                
                                <img src="images/<?php echo $row["image"]; ?>" width="150px" height="150px" alt="image">
                                <button type="submit" formaction="likes.php?user=<?php echo $user;?>&img=<?php echo $row["image"]?>" <?php 
                                        $imge = $row['image'];
                                        $likes = "SELECT * FROM likes WHERE user = '$user' AND image = '$imge'";
                                        if ($res2 = $conn->query($likes))
                                        {
                                            if ($res2->fetchColumn() > 0)
                                            {
                                                foreach($conn->query($likes) as $lik)
                                                {
                                                    $liked = $lik['lik'];
                                                }
                                                if ($liked)
                                                echo 'style = "background-color: #621bf5; color: white"';
                                                else
                                                echo 'style = "background-color: none"';
                                                
                                            }
                                        }
                                        ?>><?php 
                                        if ($liked && $imge = $row['image'])
                                        echo "unlike";
                                        else if (!$liked)
                                        echo "like";
                                        ?></button>
                                    <input type="text" name="comment" placeholder="write your comment here">
                                    <button type="submit">comment</button>
                                    <!-- <button type="submit" formaction="pictureBtn()" class="picturebtn showComments"></button> -->
                                    
                                </div>
                            </form>
                            <div id="more">
                                <!-- display comments here -->
                                <?php 
                                    $sq = "SELECT * FROM comments WHERE image = '$imge' LIMIT 1";
                                    //$result = 0;
                                    if($result = $conn->query($sq))
                                    {
                                        if ($result->fetchColumn() > 0)
                                        {
                                            // echo "we will be here";
                                            foreach($conn->query($sq) as $all)
                                            {
                                                ?>
                                                <b><?php echo $all['user'];?></b><br/>
                                                <hr/>
                                                <p><?php echo $all['comment'] ?></p>
                                            <?php
                                            }
                                        }
                                    }
                                    else 
                                        echo "failed\n";
                                ?>
                            </div>
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