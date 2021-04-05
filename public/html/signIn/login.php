<?php require_once('../../../private/initialize.php'); ?>

<?php 
    $errors = [];
    $username = '';
    $password = '';
    $customer = [];
    $member = [];

    if (isPostRequest()) {
        $username = $_POST['your_username'] ?? '';
        $password = $_POST['your_pass'] ?? '';

        //Validations
        if (isBlank($username)) {
            $errors[] = "Username cannot be blank.";
        }
        if (isBlank($password)) {
            $errors[] = "Password cannot be blank.";
        }    
        
        //If no errors, try to login
        if (empty($errors)) {
            $loginFailMsg = "Login was unsuccessful.";
            $member = find_member_by_username($username);
            if ($member) {
                if (password_verify($password, $member['HashedPassword'])) {
                    //password matches
                    logInMember($member, $db);
                    redirectTo(urlFor('html/members/members.php'));
                }
                else {
                    //username matches, but password does not match
                    $errors[] = $loginFailMsg;
                }
            }
            else {
                //no username found
                $errors[] = $loginFailMsg;
            }   
        }           
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <?php 
    $pageTitle = 'Log In'; 
    ?>
    
    <?php include(SHARED_PATH . '/headMain.inc'); ?>

    <link rel="stylesheet" href="<?php echo urlFor('css/registration/register.css'); ?>">
</head>
<body id="reg">
    <div class="wrapper">            
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="<?php echo urlFor('images/form/pottery.jpg') ?>" alt="sing up image"></figure>
                    <?php 
                        //display if user tried to access restricted page without logging in
                        if (isset($_SESSION['access'])) {
                            echo '<a class="signup-image-link" href="' . urlFor('/html/signIn/verify_customer.php') . '">Become Member</a>';
                            echo '<a class="signup-image-link" href="' . urlFor(('/html/signIn/customer_registration.php')) . '">Become Customer</a><br>';
                            unset($_SESSION['access']);
                        }
                    ?>                    
                    <a class="signup-image-link" href="<?php echo urlFor('/index.php') ?>">Go back to website</a>
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Log In</h2>
                    <?php   
                        //displayed if the registration was completed just before the transfer to this page                
                        echo displaySessionMessage();
                        
                        //display errors
                        echo displayErrors($errors);
                    ?>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="your_username" id="your_username" value="<?php echo h($username) ?>" placeholder="Username" required/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="your_pass" id="your_pass" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="login" id="login" class="form-submit" value="Log in"/>
                        </div>
                    </form>                   
                </div>
            </div>
        </div>  
    </div>

    <?php 
        //disconnect from the database
        db_disconnect($db);
    ?>
</body>
</html>