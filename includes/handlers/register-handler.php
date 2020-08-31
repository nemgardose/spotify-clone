<?php

function sanitizeFormUsername($inputText) {
    $inputText = strip_tags($inputText);  //removes any html tags for security purpose
    $inputText = str_replace(" ", "", $inputText); //replace any spaces in input from username
    return $inputText;
}

function sanitizeFormString($inputText) {
    $inputText = strip_tags($inputText); 
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}

function sanitizeFormPassword($inputText) {
    $inputText = strip_tags($inputText); 
    return $inputText;
}

    if(isset($_POST['signUpButton'])) {
        //signUp button was pressed

        $username = sanitizeFormUsername($_POST['username']);
        $firstname = sanitizeFormString($_POST['firstname']);
        $lastname = sanitizeFormString($_POST['lastname']);
        $email = sanitizeFormString($_POST['email']);
        $confirm_email = sanitizeFormString($_POST['confirm_email']);
        $password = sanitizeFormPassword($_POST['password']);
        $confirm_password = sanitizeFormPassword($_POST['confirm_password']);

        $wasSuccessful = $account->register($username, $firstname, $lastname, $email, $confirm_email, $password, $confirm_password);

        if($wasSuccessful == true) {
            $_SESSION['userLoggedIn'] = $username;
            header("Location: index.php");
        } 
    }

?>