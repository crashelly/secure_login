$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'process_login.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response && response.status) {
                    Swal.fire('Éxito', response.message, 'success').then(function() {
                        window.location.href = 'menup.php'; // Redirigir después del login exitoso
                    });
                } else {
                    Swal.fire('Error', response.message || 'Error desconocido', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud:', status, error);
                Swal.fire('Error', 'No se pudo completar la solicitud', 'error');
            }
        });
    });

    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'register_user.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response && response.status) {
                    Swal.fire('Éxito', response.message, 'success').then(function() {
                        window.location.href = 'index.php'; // Redirigir después del registro exitoso
                    });
                } else {
                    Swal.fire('Error', response.message || 'Error desconocido', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud:', status, error);
                Swal.fire('Error', 'No se pudo completar la solicitud', 'error');
            }
        });
    });

    $('#togglePassword').on('click', function() {
        var passwordField = $('#password');
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        $(this).text(type === 'password' ? 'Ver' : 'Ocultar');
    });

    $('#togglePasswordRegister').on('click', function() {
        var passwordField = $('#registerPassword');
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        $(this).text(type === 'password' ? 'Ver' : 'Ocultar');
    });

    $('#generatePassword').on('click', function() {
        var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+';
        var password = '';
        for (var i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        $('#registerPassword').val(password);
    });
});