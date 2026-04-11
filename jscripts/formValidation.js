document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('settings').addEventListener('submit', function(event) {
        let isValid = true;
        let errorMessages = {
            'name': 'Name is required.',
            'last': 'Last name is required.',
            'email': 'Invalid email format.',
            'user': 'Username is required.',
            'password': 'Password is required.'
        };
        
        // Clear previous error messages
        document.querySelectorAll('.errormsg').forEach(e => e.innerText = '');

        // Validate name
        let name = event.target.name.value.trim();
        if (name === '') {
            showError('name', errorMessages['name']);
            isValid = false;
        }

        // Validate last name
        let lastName = event.target.last.value.trim();
        if (lastName === '') {
            showError('last', errorMessages['last']);
            isValid = false;
        }

        // Validate email
        let email = event.target.email.value.trim();
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            showError('email', errorMessages['email']);
            isValid = false;
        }

        // Validate user
        let user = event.target.user.value.trim();
        if (user === '') {
            showError('user', errorMessages['user']);
            isValid = false;
        }

        // Validate password
        let password = event.target.password.value;
        if (password === '') {
            showError('password', errorMessages['password']);
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }

        function showError(field, message) {
            let errorSpan = document.querySelector(`.errormsg[id='errormsg_${field}']`);
            if (errorSpan) {
                errorSpan.innerText = message;
            }
        }
    });
});
