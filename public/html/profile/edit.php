<?php require_once('../../../private/initialize.php'); ?>

<?php requireLogin(); ?>

<?php 
    $customer = [];
    $customerDB = [];

    $customerDB = find_customer_by_id($_SESSION['customerID']);
    
    $customer['id'] = $_SESSION['customerID'];
    $customer['firstName'] = $_POST['firstName'] ?? $customerDB['CustomerGivenName'];
    $customer['lastName'] = $_POST['lastName'] ?? $customerDB['CustomerLastName'];
    $customer['address'] = $_POST['address'] ?? $customerDB['CustomerAddress'];
    $customer['email'] = $_POST['email'] ?? $customerDB['CustomerEmail'];
    $customer['phone'] = $_POST['phone'] ?? $customerDB['CustomerPhoneNumber'];
    
    if (isPostRequest()) {
        $result = update_customer($_POST, $customer['id']);
        if ($result === true) {
            $_SESSION['message'] = 'Your changes were applied successfully!';
        }
        else {
            $errors = $result;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo urlFor("/css/form/material-icon/material-design-iconic-font.min.css"); ?>">

    <!-- Form css -->
    <link rel="stylesheet" href="<?php echo urlFor("/css/form/styleForm.css"); ?>">    
    
    <?php 
    $pageTitle = 'Edit Profile'; 
    $section = 'Profile';   
    ?>
    
    <?php include(SHARED_PATH . '/headMain.inc'); ?>
    
</head>
<body>

    <?php include(SHARED_PATH . '/headerMain.inc'); ?>

    <main>
        <div class="container">         
            <div class="signup-content">
                <div class="signup-form">
                   
                    <h2 class="form-title">Edit Personal Information</h2>

                    <?php   
                        //displayed if the registration was completed just before the transfer to this page                
                        echo displaySessionMessage();
                        
                        //display errors
                        echo displayErrors($errors);
                    ?>

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
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree with all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signupCustomer" id="signupCustomer" class="form-submit" value="Save Changes"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">                  
                    <figure><img src="<?php echo urlFor("images/form/pottery2.jpg"); ?>" alt="sing up image"></figure>
                </div>
            </div>
        </div>
    </main>

    <?php include(SHARED_PATH . '/footer.inc'); ?>
    
</body>
</html>