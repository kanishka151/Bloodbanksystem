document.getElementById('registration-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match');
    } else {
        const passwordStrength = checkPasswordStrength(password);
        
        if (passwordStrength === 'weak' || passwordStrength === 'medium') {
            document.getElementById('password-info').textContent = 'Password should be strong with alphanumeric characters and special symbols';
            return; // Stop further processing
        }

        // Here you can add your authentication logic
        //alert('Registration successful');
        
        
    }
});

document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const passwordStrength = checkPasswordStrength(password);
    
    if (passwordStrength === 'weak' || passwordStrength === 'medium') {
        document.getElementById('password-info').textContent = 'Weak Password! It should include alphanumeric characters and special symbols';
    } else {
        document.getElementById('password-info').textContent = '';
    }
});

function checkPasswordStrength(password) {
    let strength = 0;

    if (password.match(/[a-z]/)) {
        strength++;
    }

    if (password.match(/[A-Z]/)) {
        strength++;
    }

    if (password.match(/[0-9]/)) {
        strength++;
    }

    if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/)) {
        strength++;
    }

    switch (strength) {
        case 0:
        case 1:
            return 'weak';
        case 2:
            return 'medium';
        case 3:
        case 4:
            return 'strong';
    }
}

