<ul class="side-nav-mob">
    <li><h2>Company Information</h2></li>
        <li <?php if($pageTitle == "Company Background") {echo 'class="active"';}?> ><a href="<?php echo urlFor("/html/aboutUs/companyInformation/company_bg.php"); ?>">Background</a></li>
        <li <?php if($pageTitle == "Mission Statement") {echo 'class="active"';}?> ><a href="<?php echo urlFor("/html/aboutUs/companyInformation/company_mission.php"); ?>">Mission</a></li>
        <li><a href="#">Design</a></li>
        <li <?php if($pageTitle == "Production Process") {echo 'class="active"';}?> ><a href="<?php echo urlFor("/html/aboutUs/companyInformation/production.php"); ?>">Production</a></li>
        <li><a href="#">Products</a></li>
</ul>

<!-- /MOBILE -->