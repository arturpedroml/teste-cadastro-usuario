document.getElementById('registrationForm').addEventListener('submit', function(event) {
    var nome = document.getElementById('nome').value.trim();
    var email = document.getElementById('email').value.trim();
    var senha = document.getElementById('senha').value.trim();
    var messageDiv = document.getElementById('message');
    
    messageDiv.innerHTML = '';
    messageDiv.className = '';
    
    if (!nome || !email || !senha) {
        event.preventDefault();
        messageDiv.innerHTML = '<p>Todos os campos são obrigatórios.</p>';
        messageDiv.className = 'error';
        return;
    }
    
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        event.preventDefault();
        messageDiv.innerHTML = '<p>Email inválido.</p>';
        messageDiv.className = 'error';
        return;
    }
    
    if (senha.length < 8) {
        event.preventDefault();
        messageDiv.innerHTML = '<p>A senha deve conter pelo menos 8 caracteres.</p>';
        messageDiv.className = 'error';
        return;
    }
});
