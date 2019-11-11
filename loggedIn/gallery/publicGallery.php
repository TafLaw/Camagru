<?php
    include_once '../../config/ConnDB.php';
    session_start();
    $conn = connDB();
    $id = $_SESSION['id'];
    $user = Null;
    $userInfo = "SELECT * FROM profiles WHERE id = '$id' LIMIT 1";
    foreach($conn->query($userInfo) as $rows)
    {
        $user = $rows['id'];
    }
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 10 ? (int)$_GET['per-page'] : 5;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gallery</title>
        <link rel="stylesheet" href="../../styles.css">
    </head>
    <body>
        <nav>
            <div class="navBar">
                <?php 
                if (!$_SESSION['id'])
                {?>
                    <button class="nav_btn" onclick="window.location.href='../../authenticate/login_signup/signin_up.php'">login</button>
                    <button class="nav_btn" onclick="window.location.href='../../authenticate/login_signup/signup.php'">sign up</button>
                <?php
                }
                else
                {?>
                <button class="nav_btn" onclick="window.location.href='../../authenticate/login_signup/logout.php'">log out</button>
                <button class="nav_btn" onclick="window.location.href='../user/editProfile.php'">Edit profile</button>
                <button class="nav_btn" onclick="window.location.href='userGallery.php'">Uploads</button>          
                <button class="nav_btn" onclick="window.location.href='publicGallery.php'">Gallery</button>
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
            $sql = "SELECT * FROM images LIMIT {$start}, {$perPage}";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            if($res = $conn->query($sql))
            {
                $tota = $stmt->rowCount();
                $pages = ceil($tota / $perPage) + 1;
                if ($res->fetchColumn() > 0)
                {
                    // echo "we will be here";
                    foreach($conn->query($sql) as $row)
                    {
                        $liked = 0;
                        $tot = 0;
                        $IMG = $row["image"];
                        $totLikes = "SELECT * FROM likes WHERE image = '$IMG'";
                        foreach($conn->query($totLikes) as $total)
                        {
                            $tot += $total['lik'];
                        }
                        ?>
                        <h4 id="totLikes"><?php 
                            if ($tot == 1)
                                echo $tot.' person liked this';
                            else
                                echo $tot.' people liked this';
                            ?></h4>
                        <?php 
                            $getUser = "SELECT * FROM profiles WHERE id = {$row['user']}";
                            foreach($conn->query($getUser) as $usern)
                            {
                                $userName = $usern['name'];
                            }
                        ?>
                        <div id="belongs"><b><?php echo $userName;?></b></div>
                        <div id="block">
                            <form method="post" action="comments.php?user=<?php echo $user;?>&img=<?php echo $row["image"]?>">
                            <div align="center" id="images">
                                <img src="images/<?php echo $row["image"]; ?>" width="150px" height="150px" alt="image">
                                <?php if (isset($_SESSION['id'])){ ?>
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
                                    <button type="submit">comment</button><?php }?>
                                     <!-- <button type="submit" formaction="pictureBtn()" class="picturebtn showComments"></button> -->
                                    
                                </div>
                            </form>
                            <?php
                            if (isset($_SESSION['id'])){?>
                            <div id="more">
                                <!-- display comments here -->
                                <?php 
                                    $sq = "SELECT * FROM comments WHERE image = '$imge'";
                                    
                                    //$result = 0;
                                    if($result = $conn->query($sq))
                                    {
                                        if ($result->fetchColumn() > 0)
                                        {
                                            // echo "we will be here";
                                            foreach($conn->query($sq) as $all)
                                            {
                                                $gID = $all['user'];
                                                $ss = "SELECT * FROM profiles WHERE id = '$gID'";
                                                foreach($conn->query($ss) as $owned)
                                                {
                                                    $commentedBy = $owned['name'];
                                                }
                                                ?>
                                                <div id="commentBlock">
                                                <b><?php echo $commentedBy;?></b><br/>
                                                <hr/>
                                                <p><?php echo $all['comment']; ?></p>
                                                </div>
                                                <br/>
                                            <?php
                                            }
                                        }
                                    }
                                    else 
                                        echo "failed\n";
                                ?>
                            </div><?php }?>
                        </div>
                        <?php
                    }
                }
            }
            else 
            echo "failed\n";
            ?>
            <div class="pagination">
                <?php 
                    for ($i = 1; $i <= $pages; $i++)
                    {?>
                        <a href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage;?>"<?php 
                            if ($page === $i)
                                echo 'class="selected"';
                        ?>><?php echo $i;?></a>
                        <?php
                    }?>
                
            </div>
    </body>
    <footer>
            <hr>
            &copy; <i>tmuzeren 2019</i>
    </footer>
</html>