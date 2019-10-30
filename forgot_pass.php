<?php include 'reset_getMail';?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
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
</html>