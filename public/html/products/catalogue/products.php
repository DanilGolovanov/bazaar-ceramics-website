<?php require_once('../../../../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php 
    $pageTitle = 'Products'; 
    ?>
     
    <link rel="stylesheet" href="../../../css/members.css">
    <?php include(SHARED_PATH . '/headSidenav.inc'); ?>
    
</head>
<body>

    <?php include(SHARED_PATH . '/headerProducts.inc'); ?>

    <main>
        <h1>Products</h1>
        <article id="content">
            <h3>Catalogue</h3>
            <?php 
                //display session message
                echo displaySessionMessage();
            ?>
            <div class="responsive-table">
                <div class="block">
                    <div class="row">
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('/bazaar_ceramics_ss/public/html/members/orders/members_order.php?bcpot002/Red Bowl/<?php echo isLoggedIn() ? 220 : 420; ?>'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot002_smaller.jpg"); ?>" alt="Red Bowl" />
                            </a>            
                            <p>
                                Red Bowl <span class="new-line"><br></span>
                                <?php 
                                    if (isLoggedIn()) {
                                        echo '(Price: <span class="old-price">420$</span> 220$)';
                                    }
                                    else {
                                        echo '(Price: 420$)';
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('/bazaar_ceramics_ss/public/html/members/orders/members_order.php?bcpot006/Chun Bowl/<?php echo isLoggedIn() ? 350 : 550; ?>'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot006_smaller.jpg"); ?>" alt="Blue Chun Bowl" />
                            </a>                                       
                            <p>
                                Chun Bowl <span class="new-line"><br></span>
                                <?php 
                                    if (isLoggedIn()) {
                                        echo '(Price: <span class="old-price">550$</span> 350$)';
                                    }
                                    else {
                                        echo '(Price: 550$)';
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('/bazaar_ceramics_ss/public/html/members/orders/members_order.php?bcpot009/Moonscape Bowl/<?php echo isLoggedIn() ? 320 : 520; ?>'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot009_smaller.jpg"); ?>" alt="High Calcium Moonscape bowl" />
                            </a>                  
                            <p>
                                Moonscape Bowl <span class="new-line"><br></span>
                                <?php 
                                    if (isLoggedIn()) {
                                        echo '(Price: <span class="old-price">520$</span> 320$)';
                                    }
                                    else {
                                        echo '(Price: 520$)';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
               
                <div class="block">
                    <div class="row">
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('/bazaar_ceramics_ss/public/html/members/orders/members_order.php?bcpot010/Blue Bowl/<?php echo isLoggedIn() ? 275 : 475; ?>'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot010_smaller.jpg"); ?>" alt="Blue Glaze Bowl">
                            </a>    
                            <p>
                                Blue Bowl <span class="new-line"><br></span>
                                <?php 
                                    if (isLoggedIn()) {
                                        echo '(Price: <span class="old-price">475$</span> 275$)';
                                    }
                                    else {
                                        echo '(Price: 475$)';
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('/bazaar_ceramics_ss/public/html/members/orders/members_order.php?bcpot013/Crystalline Bowl/<?php echo isLoggedIn() ? 250 : 450; ?>'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot013_smaller.jpg"); ?>" alt="Blue Green Crystalline bowl">
                            </a>    
                            <p>
                                Crystalline Bowl <span class="new-line"><br></span>
                                <?php 
                                    if (isLoggedIn()) {
                                        echo '(Price: <span class="old-price">450$</span> 250$)';
                                    }
                                    else {
                                        echo '(Price: 450$)';
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('/bazaar_ceramics_ss/public/html/members/orders/members_order.php?bcpot020/Copper Red Dish/<?php echo isLoggedIn() ? 450 : 650; ?>'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot020_smaller.jpg"); ?>" alt="Shallow Copper Red dish ">
                            </a>    
                            <p>
                                Copper Red Dish <span class="new-line"><br></span>
                                <?php 
                                    if (isLoggedIn()) {
                                        echo '(Price: <span class="old-price">650$</span> 450$)';
                                    }
                                    else {
                                        echo '(Price: 650$)';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
            
    <?php include(SHARED_PATH . '/footer.inc'); ?>

    <script type="text/javascript" src="<?php echo urlFor("/scripts/checkNewPage.js"); ?>"></script> 
</body>
</html>