<?php
    session_start();
    include '../../../config/ConnDB.php';
    $conn = connDB();
    
    if (!isset($_SESSION['id']))
        header("location: ../../../authenticate/login_signup/signin_up.php");
    else
    {
        if (isset($_POST['submit']))
        {
            $conn = connDB();
            $uid = $_SESSION['id'];
            $dir = "image/";
            $fName = $_FILES["file"]["name"];
            $checkFile = $dir. basename($fName);
            $isImage = 1;
            $ExtFormat = end(explode('.', $fName));
            $validFormat = array ('jpg', 'png', 'jpeg');
    
            $dat = date("d F Y");
            $userInfo = "SELECT * FROM profiles WHERE id = '$uid' LIMIT 1";
            foreach($conn->query($userInfo) as $rows)
            {
                $user = $rows['name'];
            }
            //check if it's an image
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check)
                $isImage = 1;
            else
                $isImage = 0;
            //return the user to the upload page
            //only proceed is the file is an image
            if (file_exists($checkFile))
            {
                echo "file already exist";
                $isImage = 0;
            }
            if ($_FILES["file"]["size"] > 300000)
            {
                echo '<script>alert("exceeds the maximum image size (3MB)")</script>';
                $isImage = 0;
            }
            if (!in_array($ExtFormat, $validFormat))
            {
                echo '<script>alert("could not upload image: only upload files of type jpg, jpeg, png")</script>';
                $isImage = 0;
            }
                //then redirect;
                if (!$isImage)
                {
                    echo '<script>window.location="../userGallery.php"</script>';
                }
                else
                {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $fName))
                    {
                        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                        echo var_dump($conn);
                        $stmt = $conn->prepare("INSERT INTO `images`(`user`, `image`, `upload date`) VALUES ('$user', '$fName', '$dat')");
                        $stmt->execute();
                    }
                    else 
                        echo "Sorry, there was an error uploading your file.";
                    header('location: ../userGallery.php');
                }
        }
    }
?>