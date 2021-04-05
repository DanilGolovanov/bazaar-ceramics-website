<?php  
    function isBlank($value) {
        return !isset($value) || trim($value) === '';
    }

    function hasLengthGreaterThan($value, $min) {
        $length = strlen($value);
        return $length > $min;
    }

    function hasLengthLessThan($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }

    function hasLength($value, $options) {
        if (isset($options['min']) && !hasLengthGreaterThan($value, $options['min'] - 1)) {
            return false;
        } 
        elseif (isset($options['max']) && !hasLengthLessThan($value, $options['max'] + 1)) {
            return false;
        } 
        else {
            return true;
        }
    }

    function hasInclusionOf($value, $set) {
        return in_array($value, $set);
    }

    function hasExclusionOf($value, $set) {
        return !in_array($value, $set);
    }

    function validatePassword($value) {
        $pass_regex = '/^[A-Za-z0-9.\/]{6,}/';
        if (hasLengthGreaterThan($value, 5)) {
            return preg_match($pass_regex, $value) === 1;
        }
        else {
            return false;
        }
    }

    function validateEmail($value) {
        $pass_regex = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
        return preg_match($pass_regex, $value) === 1;
    }

    function validateAgreeTerm($value) {
        return $value == 1;
    }

    function hasUniqueUsername($username) {
        global $db;

        $sql = "SELECT * FROM member ";
        $sql .= "WHERE UserID='" . db_escape($db, $username) . "'";
        
        $usernames = mysqli_query($db, $sql);
        $usernameCount = mysqli_num_rows($usernames);
        mysqli_free_result($usernames);

        return $usernameCount === 0;
    }

    function hasUniquePhone($phone, $customerID="0") {
        global $db;

        $sql = "SELECT * FROM customer ";
        $sql .= "WHERE CustomerPhoneNumber = '" . $phone . "' ";
        $sql .= "AND CustomerID != '" . db_escape($db, $customerID) . "'";
        
        $phones = mysqli_query($db, $sql);
        $phoneCount = mysqli_num_rows($phones);
        mysqli_free_result($phones);

        return $phoneCount === 0;
    }
    
?>