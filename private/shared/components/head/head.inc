<?php 
    if(!isset($pageTitle)) { $pageTitle = 'Website'; }
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="<?php echo urlFor("images/bazaar_logo.png"); ?>">

<!-- Font Icon -->
<link rel="stylesheet" href="<?php echo urlFor("/css/form/material-icon/material-design-iconic-font.min.css"); ?>">

<!-- Form css -->
<link rel="stylesheet" href="<?php echo urlFor("/css/form/styleForm.css"); ?>">

<link rel="stylesheet" href="<?php echo urlFor("/css/login.css"); ?>">
<link rel="stylesheet" href="<?php echo urlFor("/css/registration/redirect.css"); ?>">

<link rel="stylesheet" href="<?php echo urlFor("/css/layout.css"); ?>">
<link rel="stylesheet" href="<?php echo urlFor("/css/style1.css"); ?>">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>

<title>Bazaar Ceramics - <?php echo $pageTitle; ?></title> 