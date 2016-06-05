<?php
//Inicia a sessão
session_start('dem');

//Chama a classe autoloader
require_once 'loader/AutoLoader.class.php';
AutoLoader::init('');

//Instância a classe util
$util = new Util();

//Se a sessão não estiver iniciada
if (!isset($_SESSION['s_login'])) {
    //Redirecina para o login
    $util->redirectPage("login");
}

/* Instância DAO do usuário */
$userdao = new UserDAO();

//Consulta o usuário pelo email
$us = new User("", "");
$login = Encryption::decode($_SESSION['s_login']);

$us->setLogin($login);
$user = $userdao->readByLogin($us);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel | DEM Monitoramento</title>
        <base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/DEMMonitoramento/">
        <meta name="viewport" content=" width=device-width, user-scalable=no"/>
        <link href="<?php echo $util->getRoot() ?>view/css/uikit.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $util->getRoot() ?>view/css/components/form-file.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $util->getRoot() ?>view/css/components/tooltip.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $util->getRoot() ?>view/css/components/sticky.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $util->getRoot() ?>view/css/main.css" type="text/css" rel="stylesheet"/>
        <link href="img/logo.png" rel="shortcut icon" type="image/x-icon"/>
    </head>
    <body>
        <div id="box-modal-delete" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-slide">
                <a href="" class="uk-modal-close uk-close"></a>
                <div class="content-modal">

                </div>
            </div>
        </div>
        <div id="box-modal-new" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-slide">
                <a href="" class="uk-modal-close uk-close"></a>
                <div class="content-modal">

                </div>
            </div>
        </div>
        <div id="box-modal-edit" class="uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog-slide">
                <a href="" class="uk-modal-close uk-close"></a>
                <div class="content-modal">

                </div>
            </div>
        </div>
        <div id="menu-left-large" class="uk-hidden-small">
            <section class="column-left">
                <header>
                    <img src="img/logo_white.png"  width="80" class="logo-main"/>
                    <h2 class="text-welcome">
                        Seja Bem Vindo<br>
                        <b><?php //echo $user->getName(); ?></b>
                        <a href="logout" class="btn-logout">
                            <i class="uk-icon-sign-out"></i>
                            Sair
                        </a>
                    </h2>
                </header>
                <nav>
                    <a href="monitoramento" class="item-menu">
                        <i class="uk-icon-map-marker"></i>
                        Monitoramento
                    </a>
                    <a href="onibus" class="item-menu">
                        <i class="uk-icon-bus"></i>
                        Ônibus
                    </a>
                    <a href="frota" class="item-menu">
                        <i class="uk-icon-dashboard"></i>
                        Frota
                    </a>
                    <a href="rota" class="item-menu">
                        <i class="uk-icon-map"></i>
                        Rota
                    </a>
                    <a href="dispositivo" class="item-menu">
                        <i class="uk-icon-mobile-phone"></i>
                        Dispositivo
                    </a>
                    <a href="usuario" class="item-menu">
                        <i class="uk-icon-users"></i>
                        Usuarios
                    </a>
                </nav>
            </section>
        </div>
        <section class="content-main">
            <?php
            $pages = array(
                "monitoring",
                "bus",
                "fleet",
                "router",
                "device",
                "user"
            );
            if (isset($_GET['p'])) {
                if (in_array($_GET['p'], $pages)) {
                    include("view/".$_GET['p'] . ".php");
                } else {
                    include("view/monitoring.php");
                }
            } else {
                include("view/monitoring.php");
            }
            ?>
        </section>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/uikit.min.js"></script>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/components/upload.min.js"></script>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/components/tooltip.min.js"></script>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/components/sticky.min.js"></script>
        <script type="text/javascript" src="<?php echo $util->getRoot() ?>view/js/components/datepicker.min.js"></script>
        <script type="text/javascript" src="view/js/main.js"></script>
    </body>
</html>
