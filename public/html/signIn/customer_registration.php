<?php require_once('../../../private/initialize.php'); ?>

<?php
    $customer = [];
    $customer['firstName'] = $_POST['firstName'] ?? '';
    $customer['lastName'] = $_POST['lastName'] ?? '';
    $customer['address'] = $_POST['address'] ?? '';
    $customer['email'] = $_POST['email'] ?? '';
    $customer['phone'] = $_POST['phone'] ?? '';

    if (isPostRequest()) {
        $result = insert_customer($_POST);
        $customerID = mysqli_insert_id($db);
        if ($result === true) {
            $_SESSION['verified'] = 1;
            redirectTo(urlFor('html/signIn/member_registration.php?id=' . $customerID));
        }
        else {
            $errors = $result;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    $pageTitle = 'Customer Registration';
    ?>

    <?php include(SHARED_PATH . '/headMain.inc'); ?>
    
    <link rel="stylesheet" href="<?php echo urlFor('css/registration/register.css'); ?>">
</head>
<body id="reg">
    <div class="wrapper">

        <div class="container">

            <div class="signup-content">
                <div class="signup-form">

                    <h2 class="form-title">Customer Registration</h2>

                    <?php echo displayErrors($errors) ?>

                    <form method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <input type="text" name="firstName" value="<?php echo h($customer['firstName']) ?>" id="firstName" placeholder="First Name" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastName" value="<?php echo h($customer['lastName']) ?>" id="lastName" placeholder="Last Name" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" value="<?php echo h($customer['address']) ?>" id="address" placeholder="Address" required/>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="<?php echo h($customer['email']) ?>" id="email" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" value="<?php echo h($customer['phone']) ?>" id="phone" placeholder="Phone Number" required/>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="notify" value="0"/>
                            <input type="checkbox" name="notify" value="1" id="notify" class="agree-term"/>
                            <label for="notify" class="label-agree-term"><span><span></span></span>I want to be notified about events and special offers.</a></label>
                        </div>
                        <?php //account flag set to 0 by default ?>
                        <input type="hidden" name="account" value="0"/>
                        <div class="form-group">
                            <input type="hidden" name="agree-term" value="0"/>
                            <input type="checkbox" name="agree-term" value="1" id="agree-term" class="agree-term"/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree with all statements in <a href="#" class="term-service">Terms of service</a>.</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signupCustomer" id="signupCustomer" class="form-submit" value="Register"/>
                            <input type="button" name="clearForm" id="clearForm" class="form-submit" value="Clear"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="<?php echo urlFor("images/form/pottery2.jpg"); ?>" alt="sing up image"></figure>
                    <p>We need you to complete this customer registration in order to have you personal details for order processing.</p>
                    <br>
                    <a href="<?php echo urlFor('html/signIn/login.php'); ?>" class="signup-image-link">I am already MEMBER</a>
                    <br>
                    <a href="<?php echo urlFor('html/signIn/verify_customer.php'); ?>" class="signup-image-link">I am already CUSTOMER</a>
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
        //disconnect from the database
        db_disconnect($db);
    ?>
</body>
</html>