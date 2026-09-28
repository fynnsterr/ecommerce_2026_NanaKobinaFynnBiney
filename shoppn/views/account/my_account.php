<?php require_once __DIR__ . '/../../core/core.php'; require_login(); ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>My Account</h2>
<p>Welcome, <?= htmlspecialchars($_SESSION['customer_name'] ?? 'Customer') ?>!</p>
<p>Your account details will appear here in Task 4.</p>

<?php include __DIR__ . '/../layout/footer.php'; ?>