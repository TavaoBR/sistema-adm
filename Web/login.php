<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=Assests("/")?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=Assests("/")?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
    <style>
body{
    background: #ececec;
}
/*------------ Login container ------------*/
.box-area{
    width: 930px;
}
/*------------ Right box ------------*/
.right-box{
    padding: 40px 30px 40px 40px;
}
/*------------ Custom Placeholder ------------*/
::placeholder{
    font-size: 16px;
}
.rounded-4{
    border-radius: 20px;
}
.rounded-5{
    border-radius: 30px;
}
/*------------ For small screens------------*/
@media only screen and (max-width: 768px){
     .box-area{
        margin: 0 10px;
     }
     .left-box{
        visibility: hidden;
        height: 0px;
        overflow: hidden;
     }
     .right-box{
        padding: 20px;
     }
}
    </style>
</head>
<body>

 <!----------------------- Main Container -------------------------->
 <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
    <!--------------------------- Left Box ----------------------------->
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
           <div class="featured-image mb-3">
            <img src="<?=Assests("/")?>usuario/5987811.png" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-weight: 600;">Login</p>
           <small class="text-white text-wrap text-center" style="width: 17rem; font-weight: 600;">Para entrar na plataforma, faça o login da sua conta</small>
       </div> 
    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
        
          <div class="row align-items-center">
                <div class="header-text mb-4">
                    <?=validateSession("MensagemLogin")?>
                </div>
                <form action="<?=routerConfig()?>/user/login" method="POST" id="confirmationForm">
                    <div class="input-group mb-3">
                        <label for="">Nome de usuario</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control form-control-lg bg-light fs-6" value="<?=validateSession("loginUser")?>">
                    </div>
                    <div class="input-group mb-1">
                        <label for="">Senha</label>
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" name="senha" class="form-control form-control-lg bg-light fs-6" value="<?=validateSession("loginSenha")?>">
                    </div>
                    <div class="input-group mb-5 d-flex justify-content-between">
                        <!--<div class="forgot">
                            <small><a href="#">Forgot Password?</a></small>
                        </div>-->
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6" id="submitButton" onclick="handleSubmit()">Logar</button>
                    </div>
                </form>
                <!--<div class="input-group mb-3">
                    <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google.png" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                </div>
                <div class="row">
                    <small>Don't have account? <a href="#">Sign Up</a></small>
                </div>-->
          </div>
       </div> 
      </div>
    </div>

    <script>
    function handleSubmit() {

        const submitButton = document.getElementById('submitButton');
        submitButton.setAttribute('disabled', 'disabled');

        // Exibe o SweetAlert de carregamento
        Swal.fire({
            title: 'Enviando Requisição',
            text: 'Por favor, aguarde.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Aguarda 2 segundos antes de enviar o formulário
        setTimeout(() => {
            // Fecha o SweetAlert
            Swal.close();

            // Envia o formulário manualmente
            const form = document.getElementById('confirmationForm');
            form.submit();
        }, 2000); // 2000 milissegundos = 2 segundos
    }
</script>
    
</body>
</html>