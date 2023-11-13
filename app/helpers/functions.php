<?php
function isLogin()
{
    if (isset($_SESSION["login"]) && isset($_SESSION["id_admin"])) return true;
    elseif (isset($_SESSION["login"]) && isset($_SESSION["id_user"])) return true;
    else return false;
}
