<?php
class Home extends Controller
{

    public function __construct()
    {
        if (isLoginUser()) header("Location: " . BASEURL . "/dashboard");
    }

    public function index()
    {
        $data = [
            "title" => "Beranda",
        ];
        $this->UserView("templates/header", $data);
        $this->UserView("home/index", $data);
        $this->UserView("templates/footer");
    }

    public function informasi()
    {
        $data = [
            "title" => "Informasi",
            "marker" => "active"
        ];
        $this->UserView("templates/header", $data);
        $this->UserView("home/informasi", $data);
        $this->UserView("templates/footer");
    }
}
