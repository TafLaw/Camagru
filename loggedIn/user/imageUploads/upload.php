<?php 
    if (isset($_POST['submit']))
    {
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
            echo "exceeds the maximum image size (3MB)";
            $isImage = 0;
        }
        if (!in_array($ExtFormat, $validFormat))
        {
            echo "only upload files of type jpg, jpeg, png";
            $isImage = 0;
        }
            //then redirect;
    }
    if (!$isImage)
        echo "could not upload image";
    else
    {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $fName))
            echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        else 
            echo "Sorry, there was an error uploading your file.";
        header('location: ../editProfile.html');
    }
?>