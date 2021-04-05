<?php 
    require_once('../../../../private/initialize.php');

    $orderID = 0;
    if (isset($_POST['order'])) {
        $orderID = db_escape($db,$_POST['order']);
    }

    if ($orderID > 0) {

        //Check that record exists
        $checkRecord = mysqli_query($db,"SELECT * FROM orderline WHERE OrderID = '" . $orderID . "'");
        $totalrows = mysqli_num_rows($checkRecord);

        if ($totalrows > 0) {
            //Delete record
            $sql = "DELETE FROM orderline WHERE OrderID = '" . $orderID  . "'";

            mysqli_query($db,$sql);

            $_SESSION['cart'] = get_shopping_cart_items($_SESSION['orderID']);
            $_SESSION['cartQuantity'] = get_shopping_cart_quantity($_SESSION['orderID']);
            $_SESSION['confirmedOrder'] = 0;
            echo 1;
            exit;
        }
        else {
            echo 0;
            exit;
        }
    }

    echo 0;
    exit;
?>