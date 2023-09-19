<?php
  class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    
    public function login(){


        // Check the request method is POST
        if($_SERVER['REQUEST_METHOD']=='POST'){
          //print_r($_POST);
          // Sanitize Post Data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $data = [
            'loginMethod' => trim($_POST['loginMethod']),
            'password' => trim($_POST['password']),
            'password_err' => '',
            'empty_field_err'=> ''
    
        ];
        // Check the fields empty or not
        if(empty($data['loginMethod']) || empty($data['password']) ){
          $data['empty_field_err'] = 'Please fill the empty field&fiels!';
        }
       // Check the password  at least 6 character
       if(strlen($data['password']<6)){
        $data['password_err'] = "Password must be at least 6 characters!";
      }
        // Check the error fiels empty
        if(empty($data['empty_field_err']) && empty($data['password_err'])){
          // VALID DATA

          // Process Login
          $loggedUser = $this->userModel->login($data);
          if($loggedUser){
              // Login Successful redirect to Main Page
              $this->createUserSession($loggedUser);
              
          }else{
              die('Something went wrong!');
          }
          
          
        }else{
          // Display the errors
          $this->view('users/login', $data);
        }
        
        }else{
          $data = [
            'loginMethod' => "",
            'password' => "",
            'password_err' => '',
            'empty_field_err'=> ''
    
        ];
        $this->view('users/login', $data);
        }

      $data = [
        'loginMethod' => '',
        'password' => '',
        'loginMethod_err'=>'',
        'password_err' => '',
        'empty_field_err'=> ''

    ];
     
      $this->view('users/login', $data);
    }
   

    public function register(){

      // Check the request method is POST
      if($_SERVER['REQUEST_METHOD']=='POST'){
        //print_r($_POST);
        // Sanitize Post Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Create the data variable
        $data = [
          'username' => trim($_POST['username']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'register-password-confrim' => trim($_POST['register-password-confrim']),
          'username_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'empty_field_err'=> ''

      ];
      // Fields Validation-------------------------------------
      
      // if there is an empty field
      if(empty($data['username']) || empty($data['email']) || 
      empty($data['password']) || empty($data['register-password-confrim'])){
        // Show the error to user TODO
        $data['empty_field_err'] = 'Please fill the empty field&fiels!';
      }
      // Check the email and username alreay used or not
      if($this->userModel->findUserByUsername($data['username'])){
        //  Show the username alreay taken
        $data['username_err'] = 'Username already taken!';
      }
      if($this->userModel->findUserByEmail($data['email'])){
        //  Show the email alreay taken
        $data['email_err'] = "Email has been already used!";
      }
      // Check the password  at least 6 character
      if(strlen($data['password']<6)){
        $data['password_err'] = "Password must be at least 6 characters!";
      }
      // Check the confirm password and password fields matching
        if(!($data['password'] == $data['register-password-confrim'])){
          $data['confirm_password_err'] = 'Passwords not match!';
        }
        // Fields Validation END-------------------------------------
      
      // ERRORS EMPTY OR NOT
      if(empty( $data['username_err']) && empty( $data['password_err']) &&
      empty( $data['email_err']) && empty( $data['confirm_password_err']) &&
      empty($data['empty_field_err'])){
        // INPUTS VALID
        // Hash the password
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT); 
        if($this->userModel->register($data)){
          // Redirect to login page TODO SHOW THE SUCCESS MESSAGE IN SOMEWAY
          $_SESSION['Message'] = 'Register Successful';
          header('location:'. URLROOT .'/users/login');
        }else{
          die('Something went wrong!');
        }
      }
      else{
        // Show the view again with Errors
        $this->view('users/register', $data);
      }
    }
      else{
        $data = [
          'username' => '',
          'email' => '',
          'password' => '',
          'register-password-confrim' => '',
          'username_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'empty_field_err'=> ''
  
      ];
         
          $this->view('users/register', $data);
      }
      
      
      }
      public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        header('location:'. URLROOT . '/posts');
    }
    public function logout(){
      unset($_SESSION['user_id']);
      unset( $_SESSION['username']);
      session_destroy();
      header('location:'. URLROOT . '/pages');
    }
  }