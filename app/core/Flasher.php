<?php

class Flasher
{

    public static function set_data_input($data = [])
    {
        $_SESSION["data_input"] = $data;
    }

    public static function data_input()
    {
        if (isset($_SESSION["data_input"])) {
            $value = $_SESSION["data_input"];
            unset($_SESSION["data_input"]);
            return $value;
        }
    }

    public static function set_flash($title, $text, $icon)
    {
        $_SESSION["flash"] = [
            "title" => $title,
            "message" => $text,
            "icon" => $icon
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION["flash"])) {
            echo "<div class='d-none' id='notification' data-title='" . $_SESSION["flash"]["title"] . "' data-message='" . $_SESSION["flash"]["message"] . "' data-icon='" . $_SESSION["flash"]["icon"] . "'></div>";
            unset($_SESSION["flash"]);
        }
    }
}
