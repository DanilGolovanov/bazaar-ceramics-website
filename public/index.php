<?php require_once('../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(SHARED_PATH . '/headMain.inc'); ?>

    <?php 
    $pageTitle = 'Home'; 
    $section = $pageTitle;
    ?>
    
</head>
<body>

    <?php include(SHARED_PATH . '/headerMain.inc'); ?>

    <main>
        <h1 id="homeHeader">Bazaar Ceramics Studio</h1>
        <article id="content">
            <p>
                <img src="<?php echo urlFor("images/bazaar_logo.png"); ?>" alt="Bazaar Ceramics logo" id="bz-logo">
                Bazaar Ceramics Studio has been operating for 20 years. 
                We started as a small collective, operating in the picturesque 
                township of Hahndorf, South Australia - known for its quality 
                arts and crafts. Over the years the studio has passed through 
                a number of transformations. In the first 7 years of its 
                existence - as a co-operative, it was well known for producing 
                quality domestic ware and fine individually designed art pieces. 
                <br><br>
                Bazaar Ceramics has a wide range of products to meet the needs of 
                clients both nationally and internationally. The studio produces 
                exquisite one off sculptural pieces for the individual and corporate 
                collector. Commissions make up approximately 40% of this work. 
                These pieces can be found in board rooms, international hotels and 
                private homes as far away as the US and Germany.
                <img src="<?php echo urlFor("images/banner.jpg"); ?>" alt="Bazaar Ceramics banner" id="bz-banner">
                <br><br>
                Bazaar Ceramics also produce unique, individually designed domestic 
                ware, including full dinner sets and ovenware.
                <br><br>
                The current range of products consist of one off ceramic forms 
                (eg vase and bottle forms and dishes) using a number of traditional 
                glazes that are highly prized among ceramic collectors. 
            </p>
        </article>
    </main>

    <?php include(SHARED_PATH . '/footer.inc'); ?>
    
</body>
</html>