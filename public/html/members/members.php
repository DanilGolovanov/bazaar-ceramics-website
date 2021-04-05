<?php require_once('../../../private/initialize.php'); ?>

<?php requireLogin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php 
    $pageTitle = 'Members'; 
    $section = 'Members';
    ?>
     
    <link rel="stylesheet" href="<?php echo urlFor('/css/members.css'); ?>">
    <?php include(SHARED_PATH . '/headSidenav.inc'); ?>
    
</head>
<body>

    <?php include(SHARED_PATH . '/headerMembers.inc'); ?>

    <main>    
        <h1>Special offers for you, <?php echo $_SESSION['fullname'] ?? ''; ?>!</h1>    
        <article id="content">
            <h3>Discounted Items</h3>
            <div class="responsive-table">
                <div class="block">
                    <div class="row">
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('orders/members_order.php?bcpot002/Red Bowl/220'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot002_smaller.jpg"); ?>" alt="Red Bowl" />
                            </a>                           
                            <p>
                                Red Bowl <span class="new-line"><br></span>(Price: 220$)
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('orders/members_order.php?bcpot006/Chun Bowl/350'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot006_smaller.jpg"); ?>" alt="Blue Chun Bowl" />
                            </a>                                          
                            <p>
                                Chun Bowl <span class="new-line"><br></span>(Price: 350$)
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('orders/members_order.php?bcpot009/Moonscape Bowl/320'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot009_smaller.jpg"); ?>" alt="High Calcium Moonscape bowl" />
                            </a>                           
                            <p>
                                Moonscape Bowl <span class="new-line"><br></span>(Price: 320$)
                            </p>
                        </div>
                    </div>
                </div>
               
                <div class="block">
                    <div class="row">
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('orders/members_order.php?bcpot010/Blue Bowl/275'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot010_smaller.jpg"); ?>" alt="Blue Glaze Bowl">
                            </a>             
                            <p>
                                Blue Bowl <span class="new-line"><br></span>(Price: 275$)
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('orders/members_order.php?bcpot013/Crystalline Bowl/250'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot013_smaller.jpg"); ?>" alt="Blue Green Crystalline bowl">
                            </a>    
                            <p>
                                Crystalline Bowl <span class="new-line"><br></span>(Price: 250$)
                            </p>
                        </div>
                        <div class="column">
                            <a href="javascript:;" target="_blank" onclick="javascript:newWindow=openOrderPage('orders/members_order.php?bcpot020/Copper Red Dish/450'); return false">
                                <img class="items" src="<?php echo urlFor("/images/productsWhole/bcpot020_smaller.jpg"); ?>" alt="Shallow Copper Red dish ">
                            </a>    
                            <p>
                                Copper Red Dish <span class="new-line"><br></span>(Price: 450$)
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