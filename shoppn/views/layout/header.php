<?php if (!function_exists('is_logged_in')) { require_once __DIR__ . '/../../core/core.php'; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoppn - E-Commerce</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
<header>
    <nav>
        <a href="<?= BASE_URL ?>index.php">Home</a>

        <?php if (is_admin()): ?>
            <a href="<?= BASE_URL ?>views/admin/brand.php">Brands</a>
            <a href="<?= BASE_URL ?>views/admin/category.php">Categories</a>
            <a href="<?= BASE_URL ?>views/admin/product.php">Products</a>
        <?php endif; ?>

        <?php if (is_logged_in()): ?>
            <span>Welcome, <?= htmlspecialchars($_SESSION['customer_name'] ?? 'User') ?></span>
            <a href="<?= BASE_URL ?>views/account/my_account.php">My Account</a>
            <a href="<?= BASE_URL ?>logout.php">Logout</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>views/register.php">Register</a>
            <a href="<?= BASE_URL ?>views/login.php">Login</a>
        <?php endif; ?>
    </nav>

    <!-- Search Bar -->
    <form action="<?= BASE_URL ?>views/search_results.php" method="GET">
        <input type="text" name="user_query" placeholder="Search products...">
        <button type="submit">Search</button>
    </form>
</header>
<main>