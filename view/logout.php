<?php
session_start('dem');
require_once '../loader/AutoLoader.class.php';
AutoLoader::init('../');
$util = new Util();
session_destroy();
$util->redirectPage('login');
