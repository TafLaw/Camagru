<?php 
    session_start();
    include '../../config/ConnDB.php';
    if (!isset($_SESSION['id']))
        header("location: ../../authenticate/login_signup/signin_up.php");

    $conn = connDB();
    $id = $_SESSION['id'];
    $select = "SELECT * FROM profiles WHERE id = '$id' LIMIT 1";
    foreach($conn->query($select) as $rows)
    {
        $name = $rows['name'];
        $email = $rows['email'];
        $image = $rows['image'];
    }

    //check notification
    $sql = "SELECT * FROM profiles WHERE id = '$id' AND name = '$name' LIMIT 1";
    foreach ($conn->query($sql) as $row){
        $notif = $row['notifications'];
    }
    if ($notif)
        $button = "ON";
    else
        $button = "OFF";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" href="../../styles.css">
        <script src="../../js/pop.js"></script>
        
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button class="navButton" onclick="window.location.href='../../authenticate/login_signup/logout.php'">log out</button>
                <button class="navButton" onclick="window.location.href='editProfile.php'">Edit profile</button>
                <button class="navButton" onclick="window.location.href='../gallery/userGallery.php'">Uploads</button>
            </div>
        </nav>
        <div class="profilepic" <?php 
            if($image)
                echo 'style="background-image: URL(\'imageUploads/'.$image."')".'"'; ?>
        >
        </div>
        <div id="btndd">
            <button class="button" href="#">change profile picture</button>
            <div class="dropdown">
                <div class="sideUpload">
                    <button onclick="uploadBtn()" class="uploadbtn btn">upload</button>
                    <div id="uploadpop" class="uploadpop-cont">
                        <form action="imageUploads/upload.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="file">
                            <button type="submit" name="submit">upload</button>
                        </form>
                    </div>
                </div>
                <button onclick='window.location.href="capture.html";' class="capturebtn btn">capture</button>
            </div>
        </div>
        <p>
            <table id="editTable">
                <tr>
                    <td>USERNAME: <label style="margin-left: 30%"><?php echo $name; ?></label>
                        <button class="edit button" onclick="window.location.href='edit/editUsername.php'">edit</button>
                    </td>
                </tr>
                <tr>
                    <td>EMAIL: <label style="margin-left: 30%"><?php echo $email; ?></label>
                        <button class="edit button" onclick="window.location.href='edit/editEmail.php'">edit</button>
                    </td>
                </tr>
                <tr>
                    <td>PASSWORD HIDDEN
                        <button class="edit button" href="#">edit</button>    
                    </td>
                </tr>
                <tr>
                    <td>NOTIFICATIONS
                        <button class="edit button" onclick="window.location.href='notifications.php'"><?php echo $button; ?></button>    
                    </td>
                </tr>
            </table>
        </p>
            
    </body>
</html>