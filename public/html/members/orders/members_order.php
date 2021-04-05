<?php require_once('../../../../private/initialize.php'); ?>

<?php requireLogin(); ?>

<?php
    //verify product info from URL (compare with info in db) to prevent changes in the URL
    $url = $_SERVER['REQUEST_URI'];

    if (!verify_product_info($url)) {
        $_SESSION['message'] = 'There is no such product in our database. Try to click one of the images to review and order product.';
        redirectTo(urlFor('html/products/catalogue/products.php'));       
    }

    $orderline = find_orderline($_SESSION['orderID'], getProductInfoFromURL($url)[0]);
    $orderlineExists = $orderline['OrderID'] ?? null;
    $price = getProductInfoFromURL($url)[2];

    if (isPostRequest()) {
        //check if orderline already exists in the database
        if ($orderlineExists) { 
            $result = update_orderline($_SESSION['orderID'], $_POST['productID'], $_POST['quantity']);
        }
        else {
            $result = insert_orderline($_SESSION['orderID'], $_POST);
        }

        //operation was successful
        if ($result === true) {
            $_SESSION['message'] = $_POST['itemDescription'] . ' was added to your cart!';
            $_SESSION['cartQuantity'] = get_shopping_cart_quantity($_SESSION['orderID']);
            $_SESSION['cart'] = get_shopping_cart_items($_SESSION['orderID']);
            redirectTo(urlFor('html/profile/shopping_cart.php'));
        }
        //operation was NOT successful
        else {
            $errors = $result;
        }
    }
    else {
        //if user added this item before and haven't finalised order, the quantity field will be prepopulated with number from shopping cart
        if ($orderlineExists) { 
            $quantity = $orderline['OrderQuantity'];
            $totalPrice = $quantity * $price;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo urlFor("/css/members_order.css"); ?>">
    <link href="https://fonts.googleapis.com/css?family=Bellota+Text|Noto+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo urlFor("/images/bazaar_logo.png"); ?>">
    
    <link rel="stylesheet" href="<?php echo urlFor("/css/laptop.css"); ?>">     
    <link rel="stylesheet" href="<?php echo urlFor("/css/tablet.css"); ?>"> 
    <link rel="stylesheet" href="<?php echo urlFor("/css/mobile.css"); ?>">
    
    <!-- Preloaded images -->
    <script type="text/javascript" src="<?php echo urlFor("/scripts/preload.js"); ?>"></script>

    <title>Bazaar Ceramics - Members Order</title>

</head>
<body>
    <!-- Header -->
    <header>
        <h1>Red Bowl</h1>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Image Content -->
        <section id="images">
            <script type="text/javascript" src="<?php echo urlFor("/scripts/assembly.js"); ?>"></script>
        </section>

        <!-- Form Content --> 
        <section id="formContent">
            <h3 class="text-center mt-2">Order Item</h3>
            <form method="POST" class="container my-3" onsubmit="mySubmitFunction(event)">
                <div class="form-group row justify-content-center">
                    <label for="itemDescription" class="col-sm-2 col-form-label">Item Description</label>
                    <div class="col-sm-10" id="descBox">
                        <input type="text" class="form-control" id="itemDescription" name="itemDescription" placeholder="Item Description" value="Red Bowl" disabled>
                        <input type="hidden" name="itemDescription" class="itemDescription" value="Red Bowl">
                        <input type="hidden" name="productID" class="productID" value="bcpot002">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" onchange="calculateTotal()" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php echo $quantity ?? 1 ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10" id="priceBox">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="220" disabled>
                        <input type="hidden" name="price" class="price" value="220">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="totalPrice" class="col-sm-2 col-form-label">Total Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="totalPrice" name="totalPrice" placeholder="Total Price" value="<?php echo $totalPrice ?? $price ?>" disabled>
                        <input type="hidden" name="totalPrice" class="totalPrice" value="<?php echo $totalPrice ?? $price ?>">
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-xs-12 d-flex">
                        <button class="btn btn-primary m-1" id="clearBtn" onclick="clear()">Clear</button>
                        <!-- <button class="btn btn-primary m-1" id="totalBtn" onclick="calculateTotal()">Total</button> -->
                        <button type="submit" class="btn btn-success m-1" id="submitBtn"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</button>
                    </div>
                </div>
            </form>
        </section>
    
    </main>

    <!-- Footer -->
    <footer>
        <a onclick="window.open('', '_self', ''); window.close();">
            <img src="<?php echo urlFor("/images/cancel.png"); ?>" alt="">
        </a>
    </footer>

    <script type="text/javascript" src="<?php echo urlFor("/scripts/form.js"); ?>"></script>
</body>
</html>