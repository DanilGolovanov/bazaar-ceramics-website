<?php require_once('../../../private/initialize.php'); ?>

<?php requireLogin(); ?>

<?php

    if (isPostRequest()) {
        $result = finalise_order($_SESSION['orderID']);
        //if the order was finalised
        if ($result === true) {
            //create new empty order
            insert_customer_incompleted_order($_SESSION['customerID']);
            $_SESSION['orderID'] =  mysqli_insert_id($db);
            $_SESSION['cart'] = [];
            $_SESSION['cartQuantity'] = 0;
            $_SESSION['message'] = 'Thank you for your purchase!';
        }
    } 
    else {
        $items = $_SESSION['cart'];
        if ($_SESSION['confirmedOrder'] != 1 && $items) {
            redirectTo(urlFor('/html/profile/shopping_cart.php'));
        }
        else {
            $_SESSION['confirmedOrder'] = 0;
        }
        $customer = find_customer_by_id($_SESSION['customerID']);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bazaar Ceramics - Receipt</title>

    <?php   
        if (isPostRequest()) {
            echo "<script>window.close();</script>";
        } 
    ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="<?php echo urlFor('/images/bazaar_logo.png'); ?>">
    <link rel="stylesheet" href="<?php echo urlFor('/css/receipt.css'); ?>">

</head>
<body>
    <div class="container m-auto">
        <div class="row d-flex my-5 justify-content-center align-items-center">
            <div class="receipt-body col-xs-12 col-sm-10 col-md-6 p-sm-4 py-3">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                            <strong>Bazaar Ceramics</strong>
                            <br>
                            <u>Customer:</u> <?php echo $_SESSION['fullname'] ?>
                            <br>
                            <u>Address:</u> <?php echo $customer['CustomerAddress'] ?>
                            <?php 
                                if ($customer['CustomerState']) {
                                    echo ', <br>' . $customer['CustomerCountry'] . ', ' . $customer['CustomerState'] . ', <br>' . 
                                     $customer['CustomerSuburb'] . ', ' . $customer['CustomerPostCode'] . '<br>';
                                }
                            ?>
                            <abbr title="Phone"><u>Phone:</u></abbr> <?php echo $customer['CustomerPhoneNumber'] ?>
                        </address>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>
                            <em>Date: <?php echo date("jS \of F Y ") ?></em>
                        </p>
                        <p>
                            <em>Order #: <?php echo $_SESSION['orderID'] ?></em>
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="text-center">
                        <h1 class="text-sm-center">Receipt</h1>
                    </div>
                    </span>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center p-xs-0">#</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $productsTable = '';
                                $totalPrice = 0;
                                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                                    $productsTable .= '<tr>
                                        <td class="col-md-9">' 
                                            . $items[$i]['ProductTitle'] . '</em><br>('
                                            . $items[$i]['ProductID'] .
                                        ')</td>
                                        <td class="col-md-1 text-center">' . $items[$i]['OrderQuantity'] . '</td>
                                        <td class="col-md-1 text-center">$' . sprintf("%.2f", $items[$i]['ProductPrice']) . '</td>
                                        <td class="col-md-1 text-center">$' . sprintf("%.2f", $items[$i]['ProductPrice'] * $items[$i]['OrderQuantity']) . '</td>
                                    </tr>';
                                    $totalPrice += $items[$i]['ProductPrice'] * $items[$i]['OrderQuantity'];
                                }
                                //display products
                                echo $productsTable;
                            ?>
                            
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-right">
                                    <p>
                                        <strong>Subtotal: </strong>
                                    </p>
                                    <p>
                                        <strong>Delivery: </strong>
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p>
                                        <strong>$<?php echo sprintf("%.2f", $totalPrice) ?></strong>
                                    </p>
                                    <p>
                                        <strong>$10.00</strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                <td class="text-center text-danger"><h4><strong>$<?php echo sprintf("%.2f", $totalPrice + 10) ?></strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="submit-btn" class="btn btn-success btn-lg btn-block col-8">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Pay Now
                    </button></td>
                    <form method="POST" id="receipt-form"></form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo urlFor("/scripts/submitReceipt.js"); ?>"></script>

</body>
</html>




