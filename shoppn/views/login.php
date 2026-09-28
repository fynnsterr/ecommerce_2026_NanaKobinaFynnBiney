<?php require_once __DIR__ . '/../core/core.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>

<h2>Login</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="error" style="color: red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<form action="<?= BASE_URL ?>actions/login_action.php" method="POST">
    <label>Email:
        <input type="email" name="customer_email" required>
    </label><br>

    <label>Password:
        <input type="password" name="customer_pass" required>
    </label><br>

    <button type="submit">Login</button>
</form>

<p>No account? <a href="<?= BASE_URL ?>views/register.php">Register here</a>.</p>

<?php include __DIR__ . '/layout/footer.php'; ?>