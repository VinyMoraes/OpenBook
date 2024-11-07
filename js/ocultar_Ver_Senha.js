document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('senha');
    const passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', passwordType);
    
    // Alterna o ícone do olho (opcional)
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
