<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <style>
            #block {
                margin: 20%;
            }
            .input {
                width: 60%;
                height: 3vh;
                box-shadow: inset 0.01px 0.01px 6px #7c35f3;
            }
            .reset {
                background-color: #7750bb;
                margin-top: 8px;
                color: #ccc;
            }
            h5 {
                margin-top: -20px;
                text-align: center;
                color: red;
            }
        </style>
    </head>
    <body>
        <div id="block">
            <h3>Reset Password</h3>
            <form method = "post" action="reset_pass.php?email=<?php echo $_GET['email'];?>&id=<?php echo $_GET['id'];?>">
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" name="newpass" placeholder="Enter new password" required><br/>
                <input class="input" type="password" minlength="6" pattern="(?=\S*\d)(?=\S*[a-z])(?=\S*[A-Z])\S*" title="password must contain at least 1 uppercase, lowercase, digit, special character" name="confirm" placeholder="Confirm password" required><br/>
                <input class="reset" type="submit" name="reset" value="Reset">
                <?php echo "<h5>$error</h5>";?>
            </form>
        </div>
    </body>
</html>