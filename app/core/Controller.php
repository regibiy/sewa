<?php
class Controller
{
    public function UserView($view, $data = [])
    {
        require_once "../app/views/user/" . $view . ".php";
    }

    public function AdminView($view, $data = [])
    {
        require_once "../app/views/admin/" . $view . ".php";
    }

    public function Reporting($view, $data = [])
    {
        require_once "../app/views/reports/" . $view . ".php";
    }

    public function model($model)
    {
        require_once "../app/models/" . $model . ".php";
        return new $model;
    }
}
