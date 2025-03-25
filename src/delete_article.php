<?php
include "article.php";
include "UserReg.php";


if (isset($_GET['id']) && article::exists($_GET['id']) ) {
    $article = new article($_GET['id']  );
    if (isset($_COOKIE["rememberMe"])) {
        if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
            $user = UserReg::loginSession($_SESSION['login'], $_SESSION['pass']);
            if ($article->author = $user->id) {
                $article->delete();
            }
            else {header('Location: login.php');}
        }
    }
}
header("Location: user.php");
