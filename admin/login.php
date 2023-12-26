<?php
include_once "utils/smarter.php";
include_once "database/admin.php";

session_name("admin_session");
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['name'], $_POST['pass'])){
    $admins = new DataManager\Admin();
    if ($admins->check($_POST['name'], $_POST['pass'])){
        $_SESSION['logged'] = true;
    }
}

if ((isset($_SESSION['logged']) and $_SESSION['logged'])){
    Smarter\redirect("/admin");
}

Smarter\include_with_props("templates/head.php", [
    'title' => 'Connexion'
]);
?>
<h1>Connexion</h1>
<div>
    <form method="post">
        <label>Nom : </label>
        <input type="text" name="name" />
        <label>Mot de passe : </label>
        <input type="password" name="pass" />
        <input type="submit" value="Valider" />
    </form>
</div>