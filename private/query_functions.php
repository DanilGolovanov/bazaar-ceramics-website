<?php 

    function insert_customer($customer) {
        global $db;

        $errors = validate_customer($customer);
        if (!empty($errors)) {
            return $errors;
        }

        $sql = "INSERT INTO customer ";
        $sql .= "(CustomerGivenName, CustomerLastName, CustomerEmail, CustomerAddress, CustomerPhoneNumber, CustomerAccountFlag) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $customer['firstName']) . "',"; 
        $sql .= "'" . db_escape($db, $customer['lastName']) . "',";
        $sql .= "'" . db_escape($db, $customer['email']) . "',"; 
        $sql .= "'" . db_escape($db, $customer['address']) . "',"; 
        $sql .= "'" . db_escape($db, $customer['phone']) . "',";
        $sql .= "'" . db_escape($db, $customer['account']) . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            echo $sql;
            db_disconnect($db);
            exit;
        }
    }

    function update_customer($customer, $customerID) {
        global $db;

        $errors = validate_customer($customer, $customerID);
        if (!empty($errors)) {
            return $errors;
        }

        $sql = "UPDATE customer SET ";
        $sql .= "CustomerGivenName='"  . db_escape($db, $customer['firstName']) . "',"; 
        $sql .= "CustomerLastName='"  . db_escape($db, $customer['lastName']) . "',";
        $sql .= "CustomerEmail='"  . db_escape($db, $customer['email']) . "',"; 
        $sql .= "CustomerAddress='"  . db_escape($db, $customer['address']) . "',"; 
        $sql .= "CustomerPhoneNumber='"  . db_escape($db, $customer['phone']) . "',";
        $sql .= "CustomerAccountFlag='"  . db_escape($db, $customer['account']) . "'";
        $sql .= "WHERE CustomerID='" . $customerID . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        
        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            echo $sql;
            db_disconnect($db);
            exit;
        }
    }

    function validate_customer($customer, $customerID="0") {
        $errors = [];

        //first name validation
        if (isBlank($customer['firstName'])) {
            $errors[] = "First name cannot be blank.";
        }
        elseif (!hasLength($customer['firstName'], ['min' => 2, 'max' => 255])) {
            $errors[] = "First name must be between 2 and 255 characters.";
        }

        //last name validation
        if (isBlank($customer['lastName'])) {
            $errors[] = "Last name cannot be blank.";
        }
        elseif (!hasLength($customer['lastName'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Last name must be between 2 and 255 characters.";
        }

        //address validation
        if (isBlank($customer['address'])) {
            $errors[] = "Address cannot be blank.";
        }
        elseif (!hasLength($customer['address'], ['min' => 10, 'max' => 255])) {
            $errors[] = "Address must be between 10 and 255 characters.";
        }

        //email validation
        if (isBlank($customer['email'])) {
            $errors[] = "Email cannot be blank.";
        }
        if (!validateEmail($customer['email'])) {
            $errors[] = "Email should follow standard email format (e.g. john.smith@email.com)";
        }

        //phone validation
        if (isBlank($customer['phone'])) {
            $errors[] = "Phone cannot be blank.";
        }
        elseif (!hasLength($customer['phone'], ['min' => 10, 'max' => 10])) {
            $errors[] = "Phone must be 10 characters long.";
        }
        //EDIT PAGE: $customerID = $customer['id'] ?? '0';
        if (!hasUniquePhone($customer['phone'], $customerID)) {
            $errors[] = "This phone number is already associated with another account.";
        }

        //agree term validation
        if (validateAgreeTerm($customer['agree-term']) != 1) {
            $errors[] = "You must agree with Terms and Conditions.";
        }

        return $errors;
    }

    function insert_member($member, $customerID) {
        global $db;

        $errors = validate_member($member);
        if (!empty($errors)) {
            return $errors;
        }

        $hashedPassword = password_hash($member['pass'], PASSWORD_BCRYPT, ['cost' => 10]);

        $sql = "INSERT INTO member ";
        $sql .= "(CustomerID, UserID, HashedPassword) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $customerID) . "',";
        $sql .= "'" . db_escape($db, $member['username']) . "',";
        $sql .= "'" . db_escape($db, $hashedPassword) . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            echo $sql;
            db_disconnect($db);
            exit;
        }
    }

    function validate_member($member) {
        $errors = [];

        //username validation
        if (isBlank($member['username'])) {
            $errors[] = "Username cannot be blank.";
        }
        elseif (!hasLength($member['username'], ['min' => 5, 'max' => 255])) {
            $errors[] = "Username must be between 5 and 255 characters.";
        }
        if (hasInclusionOf($member['username'], ['/', '.', '%', '\\', '@', '?'])) {
            $errors[] = "Username should not have following characters: / . % \\ @ ?";
        }
        if (!hasUniqueUsername($member['username'])) {
            $errors[] = "This username is already taken.";
        }

        //password validation
        if (!hasLength($member['pass'], ['min' => 6, 'max' => 255])) {
            $errors[] = "Password must be between 6 and 255 characters.";
        }
        if (!validatePassword($member['pass'])) {
            $errors[] = "Password should consist only of following characters: A-Z a-z 0-9 . /";
        }

        //agree term validation
        if (validateAgreeTerm($member['agree-term']) != 1) {
            $errors[] = "You must agree with Terms and Conditions.";
        }

        return $errors;
    }

    function find_customer_by_id($customerID) {
        global $db;

        $sql = "SELECT * FROM customer ";
        $sql .= "WHERE CustomerID='" . db_escape($db, $customerID) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $customer = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $customer; 
    }

    function find_customer_by_phone($phone) {
        global $db;

        $sql = "SELECT CustomerID FROM customer ";
        $sql .= "WHERE CustomerPhoneNumber='" . db_escape($db, $phone) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $id = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $id; 
    }

    function find_member_by_username($username) {
        global $db;

        $sql = "SELECT * FROM member ";
        $sql .= "WHERE UserID='" . db_escape($db, $username) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $member = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $member; 
    }

    function find_member_by_customerID($customerID) {
        global $db;

        $sql = "SELECT * FROM member ";
        $sql .= "WHERE CustomerID='" . db_escape($db, $customerID) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $member = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $member; 
    }

    function find_customer_fullname_by_username($username) {
        global $db;

        $sql = "SELECT customer.CustomerGivenName, customer.CustomerLastName, member.CustomerID, member.UserID ";
        $sql .= "FROM customer ";
        $sql .= "INNER JOIN member ";
        $sql .= "ON customer.customerID = member.customerID ";
        $sql .= "WHERE UserID='" . db_escape($db, $username) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $customer = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $customer; 
    }
    
    function find_incompleted_customer_order($customerID) {
        global $db;

        $sql = "SELECT * FROM orders ";
        $sql .= "WHERE CustomerID ='" . db_escape($db, $customerID)  . "' && orderCompleted = 0 ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $order = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $order; 
    }

    function insert_customer_incompleted_order($customerID) {
        global $db;

        $sql = "INSERT INTO orders (CustomerID, OrderDate, OrderCompleted) ";
        $sql .= "VALUES (";
        $sql .= "'" . $customerID . "',";
        $sql .= "'" . date("Y-m-d") . "',";
        $sql .= "'0'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            echo $sql;
            db_disconnect($db);
            exit;
        }
    }

    function insert_orderline($orderID, $product) {
        global $db;

        $sql = "INSERT INTO orderline (OrderID, ProductID, OrderQuantity) ";
        $sql .= "VALUES (";
        $sql .= "'" . $orderID . "',";
        $sql .= "'" . $product['productID'] . "',";
        $sql .= "'" . $product['quantity'] . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            echo $sql;
            db_disconnect($db);
            exit;
        }
    }

    function verify_product_info($url) {
        global $db;
        
        //[0] - productID
        //[1] - product description (need to be url decoded)
        //[2] - price
        $info = getProductInfoFromURL($url);

        $sql = "SELECT * FROM product ";
        $sql .= "WHERE ProductID ='" . db_escape($db, $info[0])  . "' && ";
        $sql .= "ProductTitle = '" . db_escape($db, urldecode($info[1]))  . "' && ";
        $sql .= "ProductPrice = '" . db_escape($db, $info[2])  . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $product = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($product['ProductID']) {
            return true;
        }
        else {
            return false;
        }
    }

    function get_shopping_cart_items($orderID) {
        global $db;

        $sql = "SELECT * FROM product ";
        $sql .= "INNER JOIN orderline ";
        $sql .= "ON product.ProductID = orderline.ProductID ";
        $sql .= "WHERE OrderID ='" . db_escape($db, $orderID)  . "'";
        
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $items = [];
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $items[$count] = $row;
            $count++;
        }
        mysqli_free_result($result);
        return $items; 
    }

    function find_product_by_productID($productID) {
        global $db;

        $sql = "SELECT * FROM product ";
        $sql .= "WHERE ProductID ='" . db_escape($db, $productID) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $product = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $product; 
    }

    function find_orderline($orderID, $productID) {
        global $db;

        $sql = "SELECT * FROM orderline ";
        $sql .= "WHERE OrderID ='" . db_escape($db, $orderID)  . "' && ProductID = '" . db_escape($db, $productID) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $orderline = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $orderline; 
    }

    function update_orderline($orderID, $productID, $quantity) {
        global $db;

        $sql = "UPDATE orderline SET ";
        $sql .= "OrderQuantity='"  . db_escape($db, $quantity) . "'"; 
        $sql .= "WHERE OrderID='" . $orderID . "' && ProductID='" . $productID . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        
        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            echo $sql;
            db_disconnect($db);
            exit;
        }
    }

    function get_shopping_cart_quantity($orderID) {
        global $db;

        $items = get_shopping_cart_items($orderID);
        $quantity = 0;

        for ($i = 0; $i < count($items); $i++) { 
            $quantity += $items[$i]['OrderQuantity'];  
        }

        return $quantity; 
    }

    function finalise_order($orderID) {
        global $db;

        $sql = "UPDATE orders SET ";
        $sql .= "OrderDate='"  . date("Y-m-d") . "',"; 
        $sql .= "OrderCompleted='1'";
        $sql .= "WHERE OrderID='" . $orderID . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        
        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            echo $sql;
            db_disconnect($db);
            exit;
        }
    }

?>