  <?php 

include '../../config/ConnDB.php';
session_start();
if (isset($_POST['save-btn']))
{
    $conn = connDB();
    $id = $_SESSION['id'];
    $userData = "SELECT * FROM profiles WHERE id = '$id' LIMIT 1";
      $data = $_POST['image_data'];
      $img = explode(",", $data);
      $img = base64_decode($img[1]);
      
      $image_dir = "../gallery/images/";
      $imageId = "webcam_" . uniqid();
      if (!file_exists($image_dir))
          mkdir($image_dir);
      $filename = $imageId . '.jpeg';
      if(file_put_contents($image_dir . $filename, $img))
      {
          header("location: ../gallery/userGallery.php");
      }
      else{
          $error_msg = "An error occured while uploading your image";
      }

      foreach ($conn->query($userData) as $value)
      {
          $name = $value['name'];
      }
      $date = date("d F Y");
      $sql=$conn->prepare("INSERT INTO `images`(`user`, `image`, `upload date`) VALUES ('$name','$filename','$date')");
      $sql->execute();
  }
  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>capture</title>
        <link rel="stylesheet" href="../../styles.css">  
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button onclick="window.location.href='../gallery/publicGallery.php'">Gallery</button>
            </div>
        </nav>

        <img id="sticker1" class="grid-item sticker" src="imageUploads\boots.jpg" width="100" height="100" onclick="add_sticker(src)">

        <div id="container">
            <video id="video" playsinline autoplay></video>
       </div>
            <!-- Trigger canvas web API -->
        <div class="controller">
            <button id="snap">Capture</button>
            <button id="download_button">download</button>
        </div>
        <form name="uploadCamImage" method="POST">
            <input type="hidden" id="image" name="image_data">
            <button type="submit" id="save-btn" name="save-btn" value="OK">Save</button>
        </form>
                
                <!-- Webcam video snapshot -->
        <canvas id="canvas" width="640" height="480"></canvas>
        <script src="../../js/camera.js"></script>      
    </body>
    <footer>
            <hr>
            &copy; <i>tmuzeren 2019</i>
    </footer>
</html>