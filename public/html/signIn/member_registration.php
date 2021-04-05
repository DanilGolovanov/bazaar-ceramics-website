<?php require_once('../../../private/initialize.php'); ?>

<?php 
    $member = [];
    $member['username'] = $_POST['username'] ?? '';

    if ($_SESSION['verified'] == 1) {
        if (isPostRequest()) {
            $customerID = $_GET['id'];
            $result = insert_member($_POST, $customerID);
            if ($result === true) {
                unset($_SESSION['verified']);        
                $_SESSION['message'] = 'Member record was created! You can login now.';
                redirectTo(urlFor('html/signIn/login.php'));
            }
            else {
                $errors = $result;
            }
        }
        unset($_SESSION['verified']);
    }
    else {
        redirectTo(urlFor('/html/signIn/verify_customer.php'));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php 
    $pageTitle = 'Member Registration'; 
    ?>

<?php include(SHARED_PATH . '/headMain.inc'); ?>

    <link rel="stylesheet" href="<?php echo urlFor('css/registration/register.css'); ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo urlFor("scripts/passwordConfirmation.js"); ?>"></script>
</head>
<body id="reg">

    <div class="wrapper">    
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Member Registration</h2>

                    <?php echo displayErrors($errors) ?>

                    <form method="POST" class="register-form" id="register-form" onsubmit="return checkPassword()">
                        <div class="form-group">
                            <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="username" value="<?php echo h($member['username']) ?>" id="username" placeholder="Username" required/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" value="" id="pass" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" value="" id="re_pass" placeholder="Repeat your password" required/>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="agree-term" value="0"/>
                            <input type="checkbox" name="agree-term" value="1" id="agree-term" class="agree-term"/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree with all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup_member" id="signup_member" class="form-submit" value="Register"/>
                            <input type="button" name="clearForm" id="clearForm" class="form-submit" value="Clear"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="<?php echo urlFor("images/form/pottery2.jpg"); ?>" alt="sing up image"></figure>
                    <a href="<?php echo urlFor('html/signIn/login.php'); ?>" class="signup-image-link">I am already MEMBER</a>
                    <br>
                    <a href="<?php echo urlFor('html/signIn/customer_registration.php'); ?>" class="signup-image-link">I am NEW CUSTOMER</a>
                    <br><br>
                    <a onclick="window.open('', '_self', ''); window.close();">
                        <img id="cancel" src="<?php echo urlFor('images/cancel.png'); ?>" alt="">
                    </a>    
                </div>
            </div>
        </div> 
    </div>

    <script type="text/javascript" src="<?php echo urlFor("scripts/registrationForms.js"); ?>"></script>
    <?php 
        $_SESSION['verified'] = 1;
        //disconnect from the database
        db_disconnect($db);
    ?>
</body>
</html>