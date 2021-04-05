<?php 
    require_once('../../../../private/initialize.php');

    $productID = 0;
    $orderID = 0;
    $quantity = 0;
    if (isset($_POST['order']) && isset($_POST['product']) && isset($_POST['quantity'])) {
        $orderID = db_escape($db,$_POST['order']);
        $productID = db_escape($db,$_POST['product']);
        $quantity = db_escape($db, $_POST['quantity']);
    }

    if ($orderID > 0) {

        //Check that record exists
        $checkRecord = mysqli_query($db,"SELECT * FROM orderline WHERE OrderID = '" . $orderID . "' && ProductID = '" . $productID . "' LIMIT 1");
        $totalrows = mysqli_num_rows($checkRecord);

        if ($totalrows > 0) {
            //Delete record
            $sql = "UPDATE orderline SET OrderQuantity = '" . $quantity . "' WHERE OrderID = '" . $orderID . "' && ProductID = '" . $productID . "' LIMIT 1";

            mysqli_query($db,$sql);

            $_SESSION['cart'] = get_shopping_cart_items($_SESSION['orderID']);
            $_SESSION['cartQuantity'] = get_shopping_cart_quantity($_SESSION['orderID']);
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