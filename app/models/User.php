
<?php 
    class User{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query("INSERT INTO users (username,email,password) VALUES (:uname,:mail,:pass)");
            $this->db->bind(":uname",$data['username']);
            $this->db->bind(":mail",$data['email']);
            $this->db->bind(":pass",$data['password']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }
        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM users WHERE email =:email");
            $this->db->bind(':email',$email);
            $row = $this->db->single();
            if(!empty($row)){
                return true;
            }
            else{
                return false;
            }
        }
        public function findUserByUsername($username){
            $this->db->query("SELECT * FROM users WHERE username =:username");
            $this->db->bind(':username',$username);
            $row = $this->db->single();
            if(!empty($row)){
                return true;
            }
            else{
                return false;
            }
        }

        public function login($data){
            // Check the login method email or username
            if(strpos($data['loginMethod'],'@')){
                $this->db->query("SELECT * FROM users WHERE email =:email");
                $this->db->bind(':email',$data['loginMethod']);
                $row = $this->db->single();
                if(password_verify($data['password'],$row->password)){
                    return $row;
                }else{
                    return false;
                }
            }else{
                $this->db->query("SELECT * FROM users WHERE username =:username");
                $this->db->bind(':username',$data['loginMethod']);
                $row = $this->db->single();
                if(password_verify($data['password'],$row->password)){
                    return $row;
                }else{
                    return false;
                }
            }
        }
        

    }
?>