<?php require_once('../../../../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $pageTitle = 'Company Background'; ?>
    <?php include(SHARED_PATH . '/headSidenav.inc'); ?>
</head>
<body>

    <?php include(SHARED_PATH . '/headerAboutUs.inc'); ?>

    <main>

        <h1>Company Background</h1>

        <article id="content">

        <p><img src= "<?php echo urlFor("/images/bazaar_logo.png"); ?>" alt="Bazaar Ceramics logo" id="bz-logo">
                    Bazaar Ceramics Studio has been operating for 20 years.
                    We started as a small collective, operating in the picturesque
                    township of Hahndorf, South Australia - known for its quality
                    arts and crafts. Over the years the studio has passed through
                    a number of transformations. In the first 7 years of its existence -
                    as a co-operative, it was well known for producing quality domestic ware
                    and fine individually designed art pieces.
                    <br><br>
                    Each member of the co-operative was responsible for designing, throwing,
                    glazing and firing their own work. A gallery director was employed to look
                    after the gallery and all aspects of marketing.

                    <br><br>

                    <img src="<?php echo urlFor("/images/gallery/bazaar_building.jpg"); ?>" alt="Bazaar Ceramics Building" id="bz-bld">
                    As the reputation of the studio grew nationally, and production expanded
                    to meet demand, the structure of the business changed to its present form.
                    Emma Rich bought the business and moved into larger premises in Stepney, Adelaide.
                    The production staff increased and currently includes a production manager,
                    2 full time ceramic designers and 6 production potters.
                    <br><br>
                    Bazaar Ceramics has a wide range of products to meet the needs of clients both nationally
                    and internationally. The studio produces exquisite one off sculptural pieces for the individual
                    and corporate collector.  Commissions make up approximately 40% of this work.  These pieces can
                    be found in board rooms, international hotels and private homes as far away as the US and Germany.
                    <br><br>
                    Bazaar Ceramics also produce unique, individually designed domestic ware,
                    including full dinner sets and ovenware.
            </p>

        </article>
    </main>

    <?php include(SHARED_PATH . '/footer.inc'); ?>

</body>
</html>