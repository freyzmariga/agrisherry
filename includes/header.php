<?php
// includes/header.php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Agrisherry & Agritracy Fruit Seedlings Kenya - Premium grafted fruit seedlings. Avocados, Mangoes, Citrus, Exotic fruits. Nationwide delivery. Call 0723-693591.">
    <meta name="keywords" content="fruit seedlings Kenya, avocado seedlings, mango seedlings, grafted fruits, Sagana, Kenya agriculture">
    <title><?php echo isset($page_title) ? $page_title . ' | ' : ''; ?>Agrisherry Fruit Seedlings Kenya</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
    <?php if(isset($extra_css)) echo $extra_css; ?>
</head>
<body>

<!-- Top Bar -->
<div class="topbar">
    <div class="container">
        <div class="topbar-left">
            <a href="mailto:agrisherryfruitseedlings@gmail.com"><i class="fas fa-envelope"></i> agrisherryfruitseedlings@gmail.com</a>
            <a href="tel:+254723693591"><i class="fas fa-phone"></i> +254 723 693591</a>
        </div>
        <div class="topbar-right">
            <a href="https://www.facebook.com/profile.php?id=100049991118279" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://wa.me/254723693591" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <a href="tel:+254723693591"><i class="fas fa-phone-alt"></i></a>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="navbar" id="mainNav">
    <div class="container nav-container">
        <a href="index.php" class="nav-logo">
            <img src="images/logo.jpeg" alt="Agrisherry Logo">
            <div class="logo-text">
                <span class="logo-main">Agrisherry</span>
                <span class="logo-sub">Fruit Seedlings Kenya</span>
            </div>
        </a>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
        <ul class="nav-menu" id="navMenu">
            <li><a href="index.php" class="<?php echo $current_page === 'index' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="shop.php" class="<?php echo $current_page === 'shop' ? 'active' : ''; ?>">Seedlings Shop</a></li>
            <li><a href="index.php#delivery">Delivery</a></li>
            <li><a href="index.php#testimonials">Reviews</a></li>
            <li><a href="contact.php" class="<?php echo $current_page === 'contact' ? 'active' : ''; ?>">Contact</a></li>
            <li><a href="https://wa.me/254723693591?text=Hello%20Agrisherry,%20I%20need%20seedlings" class="btn-nav-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i> Order Now</a></li>
        </ul>
    </div>
</nav>
