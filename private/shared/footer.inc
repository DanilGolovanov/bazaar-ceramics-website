<footer id="footer">
	
    <div>
        <a href="#">copyright</a> &nbsp;|&nbsp;
        <a href="<?php echo urlFor("html/aboutUs/companyInformation/company_bg.php"); ?>">about us</a> &nbsp;|&nbsp;
        <a href="#">legal staff</a> <br>
    </div>
    
    <p> &copy; Danil Golovanov </p>
 
</footer>

<script type="text/javascript" src="<?php echo urlFor("scripts/navbar.js"); ?>"></script>
<script type="text/javascript" src="<?php echo urlFor("scripts/login.js"); ?>"></script>
<script type="text/javascript" src="<?php echo urlFor("scripts/checkNewPage.js"); ?>"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo urlFor("/scripts/shoppingCart.js"); ?>"></script>

<?php 
    //disconnect from the database
    db_disconnect($db);
?>