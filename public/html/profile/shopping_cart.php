<?php require_once('../../../private/initialize.php'); ?>

<?php requireLogin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo urlFor("/css/form/material-icon/material-design-iconic-font.min.css"); ?>">

    <!-- Form css -->
    <link rel="stylesheet" href="<?php echo urlFor("/css/form/styleForm.css"); ?>">    
    <link rel="stylesheet" href="<?php echo urlFor("/css/shopping_cart.css"); ?>">    

    <?php 
    $pageTitle = 'Shopping Cart'; 
    $section = 'Shopping Cart';   
    ?>

    <?php include(SHARED_PATH . '/headMain.inc'); ?>

    
</head>
<body>

    <?php include(SHARED_PATH . '/headerMain.inc'); ?>

    <?php 
        $productsForm = '';
        $totalPriceForm = 0;
        if ($items) {
            for ($i = 0; $i < count($_SESSION['cart']); $i++) { 
                $productsForm .= '<div class="product">' . 
                    '<div class="cart-info">'
                        . '<img class="cart-images" src="' . urlFor("/images/productsWhole/" . $items[$i]['ProductID'] . "_smaller.jpg") . '" alt="" />'
                        . '<div class="product-info">' 
                            . '<div><span class="blue-heading">Product Code:</span> ' . $items[$i]['ProductID'] . '</div>' 
                            . '<div><span class="blue-heading">Product Title:</span> ' . $items[$i]['ProductTitle'] . '</div>' 
                            . '<div><span class="blue-heading">Item Price:</span> $' . $items[$i]['ProductPrice'] . '</div>' 
                            //convert total price to the same format as individual price
                            . '<div class="product-total-price" data-productid="' . $items[$i]['ProductID'] . '">
                                <span class="blue-heading">Total Price:</span> $' . sprintf("%.2f", $items[$i]['ProductPrice'] * $items[$i]['OrderQuantity']) . '</div>' 
                            . '<div><span class="blue-heading">Quantity:</span><input type="number" class="cart-quantity-input" 
                                data-productid="' . $items[$i]['ProductID'] . '" 
                                data-price="' . $items[$i]['ProductPrice'] . '"
                                value="' . $items[$i]['OrderQuantity'] . '"></div>'
                        . '</div>' 
                    . '</div>'
                    . '<img class="remove-img" 
                        data-productid="' . $items[$i]['ProductID'] . '" 
                        data-orderid="' . $_SESSION['orderID'] . '" 
                        data-quantity="' . $items[$i]['OrderQuantity'] . '" src="' . urlFor("/images/remove.png") . '" alt="" />'
                . '</div>';
                $totalPriceForm += sprintf("%.2f", $items[$i]['ProductPrice'] * $items[$i]['OrderQuantity']);
            }
            $_SESSION['confirmedOrder'] = 1;
        }
        else {
            $productsForm .= '<div class="no-items">There are no items in your cart yet.<br>It\'s a good time to add some ;)</div>';
            $_SESSION['confirmedOrder'] = 0;
        }
    ?>

    <main>
        <h1 id="homeHeader">Shopping Cart</h1>
        <div class="shopping-cart-main">
            <?php   
                //displayed if the registration was completed just before the transfer to this page                
                echo displaySessionMessage();        
                //display errors
                echo displayErrors($errors);
            ?>
            <form method="POST" class="register-form" id="checkout-form">
                <?php 
                    echo $productsForm; 
                    //if there some items in the shopping cart display total
                    if ($items) {
                        echo '<div class="cart-total">Total: $' . sprintf("%.2f", $totalPriceForm) . '</div>
                            <div class="shopping-cart-controls">
                                <a id="confirm-btn" class="btn btn-success cart-confirm-btn" >
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Confirm Order
                                </a> 
                                <a class="btn btn-danger delete-cart-btn"><i class="fa fa-trash" aria-hidden="true"></i> Delete Cart</a>
                                <a class="cancel-wrapper" onclick="window.open("", "_self", ""); window.close();">
                                    <img id="cancel" src="' . urlFor('images/cancel.png') . '" alt="">
                                </a> 
                            </div>
                            ';
                    }
                ?>  
            </form>
        </div>
    </main>
        
    <?php include(SHARED_PATH . '/footer.inc'); ?>

</body>
</html>