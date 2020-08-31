<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");

    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

    
    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Spotify</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
    <link rel="icon" href="favicon.ico">
</head>
<body>

    <?php
        if(isset($_POST['signUpButton'])) {
            echo 
            '<script>
                $(document).ready(function() {
                    $("#loginForm").hide();
                    $("#registerForm").show();
            
                });
            </script>';
        } else {
            echo 
            '<script>
                $(document).ready(function() {
                    $("#loginForm").show();
                    $("#registerForm").hide();
            
                });
            </script>';
        }
    ?>

    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form action="register.php" method="POST" id="loginForm">
                    <h2>Login to your account</h2>
                    <p>
                        <label for="loginUsername">Username</label>
                        <input type="text" id="loginUsername" name="loginUsername" value="<?php getInputValue('loginUsername')?>" placeholder="e.g. bartSimpson" required>
                        <?php echo $account->getError(Constants::$loginFailed);?>
                    </p>

                    <p>
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="loginPassword" placeholder="" required>
                    </p>

                    <button type="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? | Signup here</span>
                    </div>
                </form>

                <form action="register.php" method="POST" id="registerForm">
                    <h2>Create Account</h2>
                    <p>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="e.g. bartSimpson"  value="<?php getInputValue('username')?>" required>
                        <?php echo $account->getError(Constants::$usernameCharacters);?>
                        <?php echo $account->getError(Constants::$usernameTaken);?>
                    </p>

                    <p>
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="e.g. Bart" value="<?php getInputValue('firstname')?>" required>
                        <?php echo $account->getError(Constants::$firstnameCharacters);?>
                    </p>

                    <p>
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="e.g. Simpson" value="<?php getInputValue('lastname')?>" required>
                        <?php echo $account->getError(Constants::$lastnameCharacters);?>
                    </p>

                    <p>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email')?>" required>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch);?>
                        <?php echo $account->getError(Constants::$emailInvalid);?>
                        <?php echo $account->getError(Constants::$emailTaken);?>
                    </p>

                    <p>
                        <label for="confirm_email">Confirm Email</label>
                        <input type="email" id="confirm_email" name="confirm_email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('confirm_email')?>" required>
                    </p>

                    <p>
                        <label for="loginPaspasswordsword">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your Password" required>
                        <?php echo $account->getError(Constants::$passwordDoNotMatch);?>
                        <?php echo $account->getError(Constants::$passwordNotAlphaNumeric);?>
                        <?php echo $account->getError(Constants::$passwordCharacters);?>
                    </p>

                    <p>
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="" required>
                    </p>

                    <button type="submit" name="signUpButton">SIGN UP</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? | Log in here</span>
                    </div>
                </form>
            </div>

            <div id="loginText">
                <h1>Listening is everything</h1>
                <h2>Millions of songs and podcasts. No credit card needed.</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>