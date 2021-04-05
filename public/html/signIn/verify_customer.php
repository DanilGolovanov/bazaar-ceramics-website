<?php require_once('../../../private/initialize.php'); ?>

<?php 
    if (isPostRequest()) {
        $customer = find_customer_by_phone($_POST['phone']);
        if ($customer) {
            $member = find_member_by_customerID($customer['CustomerID']);
            if ($member == null) {
                $_SESSION['verified'] = 1;
                redirectTo(urlFor('html/signIn/member_registration.php?id=' . $customer['CustomerID']));
            }
            else {
                $_SESSION['message'] = 'This phone number is already associated with another account.';
            }
        }
        else {
            $_SESSION['message'] = 'There is no customer with such number in the database.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php 
    $pageTitle = 'Verify Customer'; 
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
                    <a href="<?php echo urlFor('html/signIn/login.php'); ?>" class="signup-image-link">I am already MEMBER</a>
                    <br>
                    <a href="<?php echo urlFor('html/signIn/customer_registration.php'); ?>" class="signup-image-link">I am NEW CUSTOMER</a>
                </div>
                <div class="signin-form">
                    <h2 class="form-title">&nbsp;Verify Customer</h2>
                    <?php echo displaySessionMessage(); ?>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <p class="acknowledge">
                                You have indicated that you are an existing Bazaar Ceramics customer. This means that you 
                                already have been registered before and there is an existing record with your information in our 
                                database. <br><br>
                                Please provide your <strong>phone number, which was used for registration before</strong>. We need it to 
                                verify your identity and link your personal information to new member record that you will create 
                                in the next step.
                            </p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" placeholder="Phone" required/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="verify" id="verify" class="form-submit" value="Verify"/>
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