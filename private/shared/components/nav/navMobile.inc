<!-- MOBILE -->

<div class="topnav-mob">
    <p id="logo-mob">Bazaar Ceramics</p>
    <div id="myLinks">
        <a href="<?php echo urlFor("/index.php"); ?>"><i class="fas fa-home"></i> Home</a>
        <a href="<?php echo urlFor("/html/aboutUs/companyInformation/company_bg.php"); ?>"><i class="fas fa-address-card"></i> About Us</a>
        <a href="<?php echo urlFor("/html/products/catalogue/products.php"); ?>"><i class="fas fa-store"></i> Products</a>
        <a href="<?php echo urlFor("/html/feedback/reviews.php"); ?>"><i class="fas fa-comments"></i> Feedback</a>
        <a href="<?php echo urlFor("/html/faq/faq.php"); ?>"><i class="fas fa-question-circle"></i> FAQ</a>
        
        <?php 
        $output = '';
        //check if user is logged in
        if (isset($_SESSION['username']) && $_SESSION['username'] != '') {                       
            //Members tab
            $output = '<a  href="' . urlFor("/html/members/members.php") . '"><i class="fas fa-smile-wink"></i> Members</a>';
            //Shopping Cart
            $output .= '<a href="' . urlFor("/html/profile/shopping_cart.php") . '" >
                            <i class="fas fa-shopping-cart"></i> Shopping Cart
                        </a> ';
            //Profile tab          
            $output .= '<a href="' . urlFor("/html/profile/edit.php") . '" >
                            <i class="fas fa-user"></i> Profile
                        </a> ';
            //Logout
            $output .= '<a href="' . urlFor("/html/profile/logout.php") . '"><i class="fas fa-sign-out-alt"></i> Logout</a> ';
        }
        else {
            //Sign In tab (if user is not logged in)
            $output = '<a href="javascript:void(0)" onclick="openLogIn()"><i class="fas fa-sign-in-alt"></i> Sign In</a>';
        }
        //display output
        echo $output;
    ?>
        
    </div>
    <a href="javascript:void(0);" class="icon" onclick="navbarCollapse()">
        <i class="fa fa-bars"></i>
    </a>
</div>