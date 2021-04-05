<?php require_once('../../../../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php $pageTitle = "Production Process"; ?>
    <link rel="stylesheet" href="<?php echo urlFor("/css/production.css") ?>">
    <?php include(SHARED_PATH . '/headSidenav.inc'); ?>
    <link rel="stylesheet" href="<?php echo urlFor("/css/slick.css") ?>">    

    <noscript>
        <style>
            .slider-back {
                display: none;
            }
        </style>
    </noscript>
    
</head>

<body>

    <?php include(SHARED_PATH . '/headerAboutUs.inc'); ?>

    <main>

        <h1>Production Process</h1>
            
        <article id="content">
                
            <p>
                Bazaar Ceramics are constantly experimenting with new designs and techniques. 
                The process of developing a particular range of ceramics, starts with the design process. 
                The ceramic designers and gallery director meet regularly to discuss new ideas for product ranges. 
                It may be that the designers are following through on an inspiration from a field trip or perhaps the
                gallery director has some suggestions to make based on feedback from customers.
            </p>
                     
            <div class="slider-back">
                <div class="slider">
                    <div class="slick-large">
                        <div><img src="<?php echo urlFor("/images/production/sequence1.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence2.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence3.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence4.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence5.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/finishing.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/finishing2.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/liftingclay.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/openingclay.jpg") ?>" alt=""></div>
                    </div>
                    <div class="slick-nav">
                        <div><img src="<?php echo urlFor("/images/production/sequence1.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence2.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence3.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence4.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/sequence5.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/finishing.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/finishing2.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/liftingclay.jpg") ?>" alt=""></div>
                        <div><img src="<?php echo urlFor("/images/production/openingclay.jpg") ?>" alt=""></div>
                    </div>
                </div>   
                
            </div>
            
            <p>
                Promising designs are developed into working drawings which the production potters use to create 
                the ceramic forms. 
                Depending on the type of decoration, the designers may apply the decoration at this stage, 
                or after they have been “bisqued” (fired to 1000 degrees celsius). 
                These prototype designs go through a lengthy development stage of testing and review until the 
                designer is happy with the finished product.  At this stage a limited number of pots are produced 
                and displayed in the gallery.  If they do well in the gallery, they become a “standard line”.  
            </p>

        </article>

    </main>

    <?php include(SHARED_PATH . '/footer.inc'); ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo urlFor("/scripts/slick.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo urlFor("/scripts/slideshow.js"); ?>"></script>

</body>
</html>