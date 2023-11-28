<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie-edge">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css " href="assets/css/style.css">
  <link rel="icon" href="assets/img/logo.png" type="image/x-icon" />
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>

<body>
  <div class="contenedor">
    <div class="img">
      <img src="assets/img/bg.svg" alt="">
    </div>
    <div class="contenido-login">

      <form id="login-form">

        <img src="assets/img/logo.png" alt="">
        <h2>Login</h2>

        <div class="input-div nit">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">

            <input type="email" id="email" name="email" required>
          </div>
        </div>
        <div class="input-div pass">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">

            <input type="password" id="senha" name="senha" required>
          </div>
        </div>


        <button class="btn" name='login' type="submit"> start session
        </button>

      </form>

    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
    $(document).ready(function() {
      $('#login-form').submit(function(event) {
        event.preventDefault();

        var email = $('#email').val();
        var senha = $('#senha').val();

        var loginData = {
          email: email,
          senha: senha
        };

        $.ajax({
          type: 'POST',
          url: 'processa_login.php',
          data: loginData,
          dataType: 'json',
          beforeSend: function() {
            $('#load').removeAttr('hidden');
          },
          success: function(response) {
            if (response.redirect) {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'user logged in successfully',
              }).then(function() {
                window.location.href = response.redirect;
              });

            } else if (response.error) {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.error
              });
            }
          },
          complete: function() {
            $('#load').attr('hidden', 'hidden');
          }
        });
      });
    });
  </script>

</body>

</html>
