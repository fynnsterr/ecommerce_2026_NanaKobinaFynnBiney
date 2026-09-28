document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('register-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        let valid = true;

        // Clear previous errors
        document.querySelectorAll('.error').forEach(el => el.textContent = '');

        // Email validation
        const email = form.customer_email.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('email-error').textContent = 'Invalid email';
            valid = false;
        }

        // Phone validation
        const phone = form.customer_contact.value.trim();
        const phoneRegex = /^[0-9+\-\s]{7,15}$/;
        if (!phoneRegex.test(phone)) {
            document.getElementById('contact-error').textContent = 'Invalid phone (7-15 digits)';
            valid = false;
        }

        // Password validation (min 8 chars, at least 1 digit)
        const pass = form.customer_pass.value;
        const passRegex = /^(?=.*\d).{8,}$/;
        if (!passRegex.test(pass)) {
            document.getElementById('pass-error').textContent = 'Min 8 chars, at least 1 digit';
            valid = false;
        }

        if (!valid) e.preventDefault(); // Stop form submission if invalid
    });
});