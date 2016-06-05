<?php
session_start('dem');
require_once '../loader/AutoLoader.class.php';
AutoLoader::init('../');
$util = new Util();
if (isset($_SESSION['s_login'])) {
    $util->redirectPage("monitoramento");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login | DEMMonitoramento</title>
        <base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/DEMMonitoramento/">
        <meta name="viewport" content=" width=device-width, user-scalable=no"/>
        <link href="<?php echo $util->getRoot() ?>view/css/styleLogin.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $util->getRoot() ?>view/css/uikit.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $util->getRoot() ?>view/image/logo.png" rel="shortcut icon" type="image/x-icon"/>
    </head>
    <body>
        <div class="background"></div>
        <header>
            <img src="image/logo.png" width="200" class="logo-login"/>
        </header>
        <section>
            <form class="form-login uk-form" action="javascript:void(0)" method="POST">

                <div class="uk-form-row uk-width-9-10 uk-align-center">
                    <label class="uk-form-label" for="user-login">Usuário</label>
                    <div class="uk-form-controls">
                        <div class="uk-form-icon">
                            <i class="uk-icon-user"></i>
                            <input id="user-login" name="user-login" type="text" placeholder="Usuário" class="uk-form-large field-login uk-form-width-large">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row uk-width-9-10 uk-align-center">
                    <label class="uk-form-label" for="pass-login">Senha</label>
                    <div class="uk-form-controls">
                        <div class="uk-form-icon">
                            <i class="uk-icon-shield"></i>
                            <input id="pass-login" name="pass-login" type="password" placeholder="Senha" class="uk-form-large field-login uk-form-width-large">
                        </div>
                    </div>
                </div>
                <div class="uk-form-row uk-width-9-10 uk-align-center">
                    <button class="uk-button uk-button-large uk-button-success uk-align-right">
                        <i class="uk-icon-sign-in"></i> Entrar
                    </button>
                    <a  href="#forget-password" data-uk-modal>Esqueci minha senha</a>
                </div>
                <div id="box-result" class="uk-alert uk-alert-primary uk-text-center uk-hidden  uk-width-9-10 uk-align-center">
                    <i></i><br>
                    <span></span>
                </div>
            </form>
        </section>
        <footer>
            <p>DEM Monitoramento© 2016 - Todos os direitos resrvados.</p>
            <img src="<?php echo $util->getRoot() ?>view/image/logo-ufma.png" height="56" width="94" class="logo-dev"/>
        </footer>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/uikit.min.js"></script>
        <script type="text/javascript">
            $(function () {

                $(".form-login").submit(function () {
                    var data = $(this).serialize();
                    $.ajax({
                        url: root+"view/VM/login.php",
                        dataType: 'html',
                        type: 'POST',
                        data: data,
                        beforeSend: function () {
                            $("#box-result").removeClass('uk-hidden');
                            $("#box-result").removeClass('uk-alert-danger');
                            $("#box-result i").removeClass("uk-icon-warning");
                            $("#box-result i").removeClass("uk-icon-warning");
                            $("#box-result").fadeIn('slow');
                            $("#box-result span").html("Acessando dados...");
                            $("#box-result i").addClass("uk-icon-cog");
                            $("#box-result i").addClass("uk-icon-small");
                            $("#box-result i").addClass("uk-icon-spin");
                        },
                        success: function (data, textStatus) {
                            
                            if (data == 1) {
                                //Cor do box
                                $("#box-result").removeClass("uk-alert-danger");
                                $("#box-result").removeClass("uk-alert-primary");
                                $("#box-result").addClass("uk-alert-success");
                                //Ícone
                                $("#box-result i").removeClass("uk-icon-warning");
                                $("#box-result i").addClass("uk-icon-cog");
                                $("#box-result i").addClass("uk-icon-small");
                                $("#box-result i").addClass("uk-icon-spin");
                                //Texto
                                $("#box-result span").html("Efetuando redirecionamento...");
                                location.href = "monitoramento";
                            } else {
                                $("#box-result i").addClass("uk-icon-warning");
                                $("#box-result i").addClass("uk-icon-small");
                                $("#box-result i").removeClass("uk-icon-spin");
                                $("#box-result").addClass("uk-alert-danger");
                                $("#box-result span").html(data);
                            }
                        },
                        error: function (xhr, er) {
                            $("#box-result i").addClass("uk-icon-warning");
                            $("#box-result i").addClass("uk-icon-small");
                            $("#box-result i").removeClass("uk-icon-spin");
                            $("#box-result").addClass("uk-alert-danger");
                            $("#box-result span").html("Erro inesperado, tente novamente.");
                        }
                    });
                });
            });
        </script>
    </body>
</html>
