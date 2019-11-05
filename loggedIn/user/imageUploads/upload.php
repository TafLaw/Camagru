<?php
    session_start();
    include '../../../connect/ConnDB.php';
    $conn = connDB();
    
    if (!isset($_SESSION['id']))
        header("location: ../../../authenticate/login_signup/signin_up.php");
    else
    {
        if (isset($_POST['submit']))
        {
            $conn = connDB();
            $uid = $_SESSION['id'];
            $dir = "imageUploads/";
            $fName = $_FILES["file"]["name"];
            $checkFile = $dir. basename($fName);
            $isImage = 1;
            $ExtFormat = end(explode('.', $fName));
            $validFormat = array ('jpg', 'png', 'jpeg');
    
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
                    echo '<script>window.location="../editProfile.php"</script>';
                }
                else
                {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $fName))
                    {
                        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                        echo var_dump($conn);
                        $stmt = $conn->prepare("UPDATE `profiles` SET image = '$fName' WHERE id = '$uid' LIMIT 1");
                        $stmt->execute();
                    }
                    else 
                        echo "Sorry, there was an error uploading your file.";
                    header('location: ../editProfile.php');
                }
        }
    }
?>