<?php $error = NULL;?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" href="../../styles.css">
        <style>
        .input {
            width: 55vw;
            height: 2.9vh;
            margin: 0px 0px 3% 7.6%;
            box-shadow: inset 0.01px 0.01px 6px #7c35f3;
        }
        .reset {
            background-color: #7750bb;
            margin: 0px 0px 3% 7.6%;
            color: #ccc;
        }
        h5 {
            margin-top: -40px;
            text-align: center;
            color: red;
        }
        </style>
    </head>
    <body>
        <nav>
            <div class="navBar">
                <button onclick="window.location.href='../../loggedIn/gallery/publicGallery.php'">Gallery</button>
            </div>
        </nav>
        <h3>Please enter your email</h3>
        <form action="reset_getMail.php" method="GET">
            <input class="input" type="email" placeholder="Email" name="email" required>
            <br/>
            <input class="reset" type="submit" name="reset" value="Reset">
        </form>
            <?php
                echo "<h5>".$error."</h5>";
            ?>
    </body>
    <footer>
            <hr>
            &copy; <i>tmuzeren 2019</i>
    </footer>
</html>