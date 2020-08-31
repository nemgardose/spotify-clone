<?php
class Account {

    private $con;
    private $errorArray;

    public function __construct($con) {
        $this->con = $con;
        $this->errorArray = array();
    }

    public function login($username, $password) {
        $password = md5($password);
        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

        if(mysqli_num_rows($query) == 1) {
            return true;
        } else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        } 
    }

    public function register($username, $firstname, $lastname, $email, $confirm_email, $password, $confirm_password) {
        $this->validateUsername($username);
        $this->validateFirstName($firstname);
        $this->validateLastName($lastname);
        $this->validateEmails($email, $confirm_email);
        $this->validatePasswords($password, $confirm_password);

        if(empty($this->errorArray) == true) {
            return $this->insertUserDetails($username, $firstname, $lastname, $email, $password);
        } else {
            return false;
        }
    }

    public function getError($error) {
        if(!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function insertUserDetails($username, $firstname, $lastname, $email, $password) {
        $encryptedPassword = md5($password);
        $profilePic = "assets/images/profile-pics/5960649.png";
        $date = date("Y-m-d");

        $result = mysqli_query($this->con, 
        "INSERT INTO users(username, firstname, lastname, email, password, created_at, profile_photo)
         VALUES ('$username', '$firstname', '$lastname', '$email', '$encryptedPassword', '$date', '$profilePic')");

        return $result;
    }

    private function validateUsername($username) {
        if(strlen($username) > 25 || strlen($username) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $checkUsernameQuery = mysqli_query($this->con, "SELECT username from users WHERE username = '$username'");

        if(mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }

    }
    
    private function validateFirstName($firstname) {
        if(strlen($firstname) > 25 || strlen($firstname) < 2) {
            array_push($this->errorArray, Constants::$firstnameCharacters);
            return;
        }
    }
    
    private function validateLastName($lastName) {
        if(strlen($lastName) > 25 || strlen($lastName) < 2) {
            array_push($this->errorArray, Constants::$lastnameCharacters);
            return;
        }
    }
    
    private function validateEmails($email, $confirm_email) {
        if($email != $confirm_email) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $checkEmailQuery = mysqli_query($this->con, "SELECT email from users WHERE email = '$email'");

        if(mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        } 
    }
    
    private function validatePasswords($password, $confirm_password) {
        if($password != $confirm_password) {
            array_push($this->errorArray, Constants::$passwordDoNotMatch);
            return;
        }

        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, Constants::$passwordNotAlphaNumeric);
            return;
        }

        if(strlen($password) > 30 || strlen($password) < 5) {
            array_push($this->errorArray, Constants::$passwordCharacters);
            return;
        }
    }
}
?>