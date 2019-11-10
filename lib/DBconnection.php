<?php
    
    class DBconnection
    {
        /*public $host     = db_host;
        public $user     = db_user;
        public $db_name  = db_name;
        public $password = db_pass;
        */
        public $link;
        public $pdo;
        
        public function __construct()
        {
          $this->dbconnect();
        }
        
        
        private function dbconnect()
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
        
        public function select($query)
        {
            
            $messageArray = ['status' => '', 'message' => ''];
            //Same logic as the insert method using try and catch.
            try {
                $prepStmt = $this->pdo->prepare($query);
                $prepStmt->execute();
                //$prepStmt->setFetchMode(PDO::FETCH_ASSOC);
                
                return $prepStmt->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $exception) {
                $messageArray['status']  = FALSE;
                $messageArray['message'] = "Error: ". $exception->getMessage();
                
                return $messageArray;
            }
            
            
            
        }
        
        public function insert($name,$user,$password)
        {
            //Associative array used to store the state and message of this method
            //status is a boolean
            $messageArray = ['status' => '', 'message' => ''];
            try {
                $this->pdo->exec();
                
                $messageArray['status']  = TRUE;
                $messageArray['message'] = ' insertion successful';
                
                return $messageArray;
                
              //  header('location: login.php?msg= post inserted...');
            } catch (PDOException $exception) {
                //here u can catch the error and return it  for further usage..
                $messageArray['message'] = $exception->getMessage();
                $messageArray['status']  = FALSE;
                
                return $messageArray;
            }
            
        }
        public function search($query)
        {
             
            $messageArray = ['status' => '', 'message' => ''];
            //Same logic as the insert method using try and catch.
            try {
                $prepStmt = $this->pdo->prepare($query);
                $prepStmt->execute();
                
                return $prepStmt->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $exception) {
                $messageArray['status']  = FALSE;
                $messageArray['message'] = "Error: ". $exception->getMessage();
                
                return $messageArray;
            }
        }
        
        public function update($query)
        {
            $update = $this->pdo->query($query);
            if ($update) {
                //header('location: index.php?msg= post updated...');
                //echo "quantity redudced";
            } else {
                echo "updating failed!!";
            }
        }
        
        public function delete($query)
        {
            $delete = $this->pdo->query($query);
            if ($delete) {
                header('location: index.php?msg= post deleted...');
            } else {
                echo "deletion failed!!";
            }
        }
        public function post($name, $price, $qty,$image)
        {
            $messageArray = ['status' => '', 'message' => ''];
            try {
                
                $result = $this->pdo->prepare("INSERT INTO buy (productname, price, quantity,image) VALUES (:pname, :price, :quantity,:images)");
                $result->bindParam(':pname', $name); 
                $result->bindParam(':price', $price); 
                $result->bindParam(':quantity', $qty);
                $result->bindParam(':images', $image);
                $result->execute();
               
                $messageArray['status']  = TRUE;
                $messageArray['message'] = 'item added to order list click on home to go back to list of items';
                
                return $messageArray;
            } catch (PDOException $exception) {
                $messageArray['status']  = FALSE;
                $messageArray['message'] = 'insertion failed!! ' . $exception->getMessage();
                
                return $messageArray;
            }
            
        }
        public function post2($name, $price, $qty,$image)
        {
            $messageArray = ['status' => '', 'message' => ''];
            try {
                
                $result = $this->pdo->prepare("INSERT INTO buy (productname, price, quantity,image) VALUES (:pname, :price, :quantity,:images)");
                $result->bindParam(':pname', $name); 
                $result->bindParam(':price', $price); 
                $result->bindParam(':quantity', $qty);
                $result->bindParam(':images', $image);
                $result->execute();
               
                $messageArray['status']  = TRUE;
                $messageArray['message'] = 'item added to order list click on home to go back to list of items';
                
                return $messageArray;
            } catch (PDOException $exception) {
                $messageArray['status']  = FALSE;
                $messageArray['message'] = 'insertion failed!! ' . $exception->getMessage();
                
                return $messageArray;
            }
            
        }
    }
    ?>