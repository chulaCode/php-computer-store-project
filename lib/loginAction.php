<?php
    
    
    include "DBconnection.php";
    
    
    class loginAction extends DBconnection
    {

        public $pdo;
        public function _construct()
        {
            
            $this->_construct();
        }
        
        private function connect()
        {
            $dsn      = 'mysql:host=127.0.0.1;dbname=computer_store';
            $password = "";
            $dbuser   = "root";

//create a PDO connection to the database
          try {
             $this->pdo = new PDO($dsn, $dbuser, $password);
             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
          } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }

        }
        
        public function register($name, $user, $password)
        {
            $messageArray = ['status' => '', 'message' => ''];
            try {
                
                $result = $this->pdo->prepare("INSERT INTO customer (cus_name, username, pass_word) VALUES (:cus_name, :username, :password)");
                $result->bindParam(':cus_name', $name); //customer name
                $result->bindParam(':username', $user); //username
                $result->bindParam(':password', $password);//password
                $result->execute();
                //header('location: login.php');
                $messageArray['status']  = TRUE;
                $messageArray['message'] = 'Your account has been Registered';
                
                return $messageArray;
            } catch (PDOException $exception) {
                $messageArray['status']  = FALSE;
                $messageArray['message'] = 'Registration failed!! ' . $exception->getMessage();
                
                return $messageArray;
            }
            
        }
        
        public function login($user, $password)
        {
            $messageArray = ['status' => '', 'message' => ''];
            $result       = $this->pdo->prepare(" SELECT * FROM customer WHERE username=? AND pass_word=?");
            $result->bindParam(1, $user);
            $result->bindParam(2, $password);
            $result->execute();
            if ($result->rowCount() > 0) {
                $user = $result->fetch(PDO::FETCH_ASSOC);
                /*Salt password to saved pass in db match $submitted_pass = sha1($user['salt'] . $this._password) */
                $submitted_pass = $password;
                
                if ($submitted_pass == $user['pass_word']) {
                    /* return $user;*/
                    $messageArray['status']  = TRUE;
                    $messageArray['message'] = 'login Success';
                    
                    return $messageArray;
                    //header('location: ../index.php?msg=login succesful...');
                } else {
                    $messageArray['message'] = "Wrong password!!";
                    $messageArray['status']  = FALSE;
                    
                    return $messageArray;
                }
            } else {
                
                $messageArray['message'] = "No value to retrieve thanks!!";
                $messageArray['status']  = FALSE;
                
                return $messageArray;
            }
            
        }
        public function user_exist($username)
        {
            $result = $this->pdo->prepare(" SELECT * FROM customer WHERE username=?");
            $result->bindParam(1, $username);
            $result->execute();
            if ($result->rowCount() > 0) {
                $user = $result->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } 
            
        }
    }