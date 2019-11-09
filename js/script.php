<?php   
    inlcude '../config/ConnDB.php';
// Requires php5   
define('UPLOAD_DIR', 'images/');   
$img = $_POST['image'];   
$img = str_replace('data:image/png;base64,', '', $img);   
$img = str_replace(' ', '+', $img);   
$data = base64_decode($img);   
$file = UPLOAD_DIR . uniqid() . '.png';   
$success = file_put_contents($file, $data);   
print $success ? $file : 'Unable to save the file.';   

    /* $sql="INSERT INTO `images`(`user`, `image`, `upload date`) VALUES ('tafadzwa',':image','8 November 2019'";

    // INSERT with named parameters
    $conn = connDB();
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":image",$_POST["image"]);
    $stmt->execute();
    $affected_rows = $stmt->rowCount();
    echo $affected_rows;
   */
?>  