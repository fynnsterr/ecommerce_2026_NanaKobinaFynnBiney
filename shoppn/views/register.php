<?php require_once __DIR__ . '/../core/core.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>

<h2>Register</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="error" style="color: red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<form id="register-form" action="<?= BASE_URL ?>actions/register_action.php" method="POST">
    <label>Full Name:
        <input type="text" name="customer_name" required>
    </label><br>

    <label>Email:
        <input type="email" name="customer_email" required>
        <span id="email-error" class="error" style="color: red;"></span>
    </label><br>

    <label>Password:
        <input type="password" name="customer_pass" required>
        <span id="pass-error" class="error" style="color: red;"></span>
    </label><br>

    <label>Country:
        <input type="text" name="customer_country" required>
    </label><br>

    <label>City:
        <input type="text" name="customer_city" required>
    </label><br>

    <label>Contact:
        <input type="text" name="customer_contact" required>
        <span id="contact-error" class="error" style="color: red;"></span>
    </label><br>

    <button type="submit">Register</button>
</form>

<script src="<?= BASE_URL ?>js/validate.js"></script>
<?php include __DIR__ . '/layout/footer.php'; ?>