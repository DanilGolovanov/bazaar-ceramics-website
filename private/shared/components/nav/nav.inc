<!-- Navbar -->
<!-- $section is used in order to higlight active page on the main navigation -->

<ul class="top-nav">
    <li><a <?php if($section == "Home") {echo 'class="active"';}?> href="<?php echo urlFor("/index.php"); ?>">Home</a></li>

    <li><div class="dropdown">
            <a <?php if($section == "About Us") {echo 'class="active"';}?> href="<?php echo urlFor("/html/aboutUs/companyInformation/company_bg.php"); ?>">
                About Us
            </a>
            <div class="dropdown-content">
                <a href="<?php echo urlFor("/html/aboutUs/companyInformation/company_bg.php"); ?>">Company Information</a>
                <a href="<?php echo urlFor("/html/aboutUs/policies&procedures/policies.php"); ?>">Policies & Procedures</a>
            </div>
        </div>
    </li>

    <li><div class="dropdown">
            <a <?php if($section == "Products") {echo 'class="active"';}?> href="<?php echo urlFor("/html/products/catalogue/products.php"); ?>">
                Products
            </a>
            <div class="dropdown-content">
                <a href="<?php echo urlFor("/html/products/catalogue/products.php"); ?>">Catalogue</a>
                <a href="<?php echo urlFor("/html/products/order/order.php"); ?>">Order</a>
                <a href="<?php echo urlFor("/html/products/delivery&care/delivery.php"); ?>">Delivery & Care</a>
            </div>
        </div>
    </li>

    <li><div class="dropdown">
            <a <?php if($section == "Feedback") {echo 'class="active"';}?> href="<?php echo urlFor("/html/feedback/reviews.php"); ?>">
                Feedback
            </a>
            <div class="dropdown-content">
                <a href="<?php echo urlFor("/html/feedback/reviews.php"); ?>">Reviews</a>
                <a href="<?php echo urlFor("/html/feedback/comment.php"); ?>">Comment</a>
            </div>
        </div>
    </li>

    <?php 
        $classProfile = '';
        $classMembers = ''; 
        $classShoppingCart = '';
        $output = '';
        //Check current page and highlight the tab
        if ($section == "Profile") {$classProfile = 'class="active"';}
        if ($section == "Members") {$classMembers = 'class="active"';}
        if ($section == "Shopping Cart") {$classShoppingCart = 'active';}
        //check if user is logged in
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') { 
            //Profile tab
            $output = '<li style="float:right;"><div class="dropdown">
                        <a ' . $classProfile . 'href="' . urlFor("/html/profile/edit.php") . '" >
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-content left-dropdown">
                            <p>Hello, ' . $_SESSION['firstname'] . '!</p>
                            <a href="' . urlFor("/html/profile/edit.php") . '">Edit Profile</a>
                            <a href="' . urlFor("/html/profile/logout.php") . '">Logout</a>
                        </div>
                    </div>
                </li> ';
            //Shopping Cart
            $items = $_SESSION['cart'];
            //count orderlines in the shopping cart and create divs for each of them
            $products = '';
            $totalPriceElement = '';
            $totalPrice = 0;
            
            if ($items) {
                for ($i = 0; $i < count($_SESSION['cart']); $i++) { 
                    $totalOrderlinePrice = $items[$i]['ProductPrice'] * $items[$i]['OrderQuantity'];
                    $products .= '<div class="nav-product"><div class="nav-product-info">' . 
                        '<img class="nav-cart-images" src="' . urlFor("/images/productsWhole/" . $items[$i]['ProductID'] . "_smaller.jpg") . '" alt="" />'
                        . '<div class="nav-cart-info">' 
                            . '<div><span class="blue-heading">Product:</span> ' . $items[$i]['ProductTitle'] . '</div>' 
                            . '<div><span class="blue-heading">Item Price:</span> $' . $items[$i]['ProductPrice'] . '</div>' 
                            //convert total price to the same format as individual price
                            . '<div class="product-total-price" data-productid="' . $items[$i]['ProductID'] . '">
                                <span class="blue-heading">Total Price:</span> $' . sprintf("%.2f", $totalOrderlinePrice) . '</div>' 
                            . '<div>
                                <span class="blue-heading">Quantity:</span>
                                <input type="number" class="cart-quantity-input" 
                                    data-productid="' . $items[$i]['ProductID'] . '" 
                                    data-price="' . $items[$i]['ProductPrice'] . '" 
                                    value="' . $items[$i]['OrderQuantity'] . '">
                               </div>'
                        . '</div></div>' 
                        . '<img class="nav-remove-img" 
                            data-productid="' . $items[$i]['ProductID'] .  '" 
                            data-orderid="' . $_SESSION['orderID'] . '" 
                            data-total="' . $totalOrderlinePrice . '" 
                            data-quantity="' . $items[$i]['OrderQuantity'] . '" src="' . urlFor("/images/remove.png") . '" alt="" />'
                    . '</div>';
                    $totalPrice += sprintf("%.2f", $totalOrderlinePrice);
                }
                //order total price
                $totalPriceElement = '<div class="nav-cart-total">Total: $' . sprintf("%.2f", $totalPrice) . '</div>';

            }
            else {
                $products .= '<div class="no-items">There are no items in your cart yet.<br>It\'s a good time to add some ;)</div>';
            }
            
            $output .= '<li style="float:right;"><div class="dropdown shop">
                        <button class="shopping-button ' . $classShoppingCart . '" >
                            <div class="cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-basket">'
                                    . $_SESSION['cartQuantity'] .
                                '</span>
                            </div>
                        </button>
                        <div class="dropdown-content left-dropdown-shopping-cart">
                            <div class="shopping-cart-dropdown">
                                <div class="products-wrapper">'
                                    . $products .
                                '</div>'
                                . $totalPriceElement .  '<input type="hidden" id="hidden-total" value="' . $totalPrice . '"> ' .
                                '<a id="checkout" href="' . urlFor("/html/profile/shopping_cart.php") . '"  >Checkout</a>
                            </div>
                        </div>
                    </div>
                </li> ';
            //Members tab
            $output .= '<li style="float:right"><a ' . $classMembers . ' href="' . urlFor("/html/members/members.php") . '">Members</a></li>';
        }
        else {
            //Sign In tab (if user is not logged in)
            $output = '<li style="float:right;"><div class="dropdown">
                    <a <?php if($section == "Sign In") href="javascript:void(0)" onclick="openLogIn()">
                        Sign In
                    </a>
                    <div class="dropdown-content left-dropdown">
                        <a href="javascript:void(0)" onclick="openLogIn()">Log In</a>
                        <a href="javascript:void(0)" onclick="openRegister()">Register</a>
                    </div>
                </div>
            </li>';
        }
        //display output
        echo $output;
    ?>

    <li style="float:right"><a <?php if($section == "FAQ") {echo 'class="active"';}?> href="<?php echo urlFor("/html/faq/faq.php"); ?>">FAQ</a></li>

    <li id="search">
        <input type="text" placeholder="Search..."><button id="btn-search">Search</button>
    </li>

</ul>