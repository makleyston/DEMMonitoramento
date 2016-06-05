<?php
session_start('dem');
require_once '../../loader/AutoLoader.class.php';
AutoLoader::init('../../');

$manager = new ManagerUser($_POST);
try {
    echo $manager->login();
} catch (FieldRequireds $ex) {
    echo "Complete todos os campos obrigatórios.";
} catch (LoginIncorrect $ex) {
    echo "Login e/ou senha incorreto(s).";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
