<?php 
    //functions for login
    function logInMember ($member, $db) {
        session_regenerate_id();
        //get customer related info
        $_SESSION['username'] = $member['UserID'];
        $_SESSION['last_login'] = time();
        $_SESSION['customerID'] = $member['CustomerID'];

        //get not finished order or create new order
        $order = find_incompleted_customer_order($_SESSION['customerID']);
        if ($order['OrderID']) {
            $_SESSION['orderID'] = $order['OrderID'];
            //get info about items in the shopping cart
            $_SESSION['cart'] = get_shopping_cart_items($_SESSION['orderID']);
            $_SESSION['cartQuantity'] = get_shopping_cart_quantity($_SESSION['orderID']);
        } 
        else {
            insert_customer_incompleted_order($_SESSION['customerID']);
            $_SESSION['orderID'] =  mysqli_insert_id($db);
            $_SESSION['cart'] = [];
            $_SESSION['cartQuantity'] = 0;
        }

        $customer = find_customer_fullname_by_username($member['UserID']);
        
        $_SESSION['fullname'] = $customer['CustomerGivenName'] . ' ' . $customer['CustomerLastName'];
        $_SESSION['firstname'] = $customer['CustomerGivenName'];
        
        return true;
    }

    function isLoggedIn() {
        return isset($_SESSION['username']);
    }

    //request login for restricted pages
    function requireLogin() {
        if(!isLoggedIn()) {
            $_SESSION['message'] = "You need to login in order to view requested page. If you are not a member yet, you need 
            to go through registration process.";
            $_SESSION['access'] = 1;
            redirectTo(urlFor('/html/signIn/login.php'));          
        }
    }

    function logOutMember() {
        unset($_SESSION['username']);
        unset($_SESSION['last_login']);
        unset($_SESSION['customerID']);
        unset($_SESSION['orderID']);
        unset($_SESSION['cart']);
        unset($_SESSION['cartQuantity']);
        unset($_SESSION['fullname']);
        unset($_SESSION['firstname']);
        unset($_SESSION['verified']);

        return true;
    }
?>