<?php 
    class userClass{
        //login
        public function login($usernameEmail, $password)
        {
            try {
                $conn = connDB();
                $passwd = hash('whirlpool', $password);
                $stmt = $conn->prepare("SELECT id FROM profiles WHERE (name=:usernameEmail or email=:usernameEmail) AND password=:passwd");
                //protect against sql injection (stored as type char / varchar)
                $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR);
                $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR);
                $stmt->execute();
                //count rows in stmt
                $rows = stmt->rowCount();
                //fetch next row and return it as an object
                $data = $stmt->fetch(PDO::FETCH_OBJ);
                if ($rowss)
                {
                    $_SESSION['id'] = $data->id;
                    return true;
                }
                else
                    return false;
            } catch (PDOException $e) {
                echo "connection failed".$e->getMessage();
            }
        }

        //register user
        public function register($username, $email, $password)
        {
            try {
                $conn = connDB();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
?>