const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password-confirm').value;
        const email = document.getElementById('email').value;
        const emailInput = document.getElementById('email');
        let emailError = '';

        // Controllo password
        if (password !== confirmPassword) {
            event.preventDefault();
            document.getElementById('passwordMismatch').style.display = 'block';
            document.getElementById('passwordMismatch').innerText = 'Le password non coincidono.';
        } else {
            document.getElementById('passwordMismatch').style.display = 'none';
        }

        // Validazione
        const lowercaseEmail = email.toLowerCase();
        emailInput.value = lowercaseEmail;
        const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;

        // Controllo caratteri maiuscoli
        if (email !== lowercaseEmail) {
            emailError = 'L\'email deve contenere solo caratteri minuscoli.';
        }
        // Controllo chiocciola
        else if (!email.includes('@')) {
            emailError = 'L\'email deve contenere una chiocciola (@).';
        }
        // Controllo dominio valido
        else if (!emailPattern.test(lowercaseEmail)) {
            emailError = 'Inserisci un dominio valido (ad esempio .com, .net, .it).';
        }

        if (emailError) {
            event.preventDefault();
            document.getElementById('emailError').innerText = emailError;
            document.getElementById('emailError').style.display = 'block';
        } else {
            document.getElementById('emailError').style.display = 'none';
        }
    });
}
