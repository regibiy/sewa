<?php
class Auth extends Controller
{

    public function __construct()
    {
        if (isLogin()) header("Location: " . BASEURL . "/admin/dashboard");
    }

    public function index()
    {
        $data = [
            "title" => "Login"
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("auth/index", $data);
        $this->AdminView("templates/footer");
    }

    public function loginprocess()
    {
        if ($this->model("Admin_Model")->get_admin_by_username($_POST["username"]) > 0) {
            $admin_data = $this->model("Admin_Model")->get_data_admin_by_username($_POST["username"]);
            if ($admin_data["password"] === $_POST["password"]) {
                if ($admin_data["status_akun"] === "Aktif") {
                    $_SESSION["login"] = "login";
                    $_SESSION["id_admin"] = $admin_data["id"];
                    $_SESSION["admin"] = $admin_data["username"];
                    $_SESSION["nama_admin"] = $admin_data["nama"];
                    $_SESSION["role"] = $admin_data["role"];

                    Flasher::set_flash("Selamat Datang", "Selamat Bekerja!", "success");
                    header("Location: " . BASEURL . "/admin/dashboard");
                    exit;
                } else {
                    Flasher::set_flash("Ups...", "Akun Anda Di-suspend!", "error");
                    header("Location: " . BASEURL . "/admin/auth");
                    exit;
                }
            } else {
                $data_input = [
                    "username" => $_POST["username"]
                ];
                Flasher::set_data_input($data_input);
                Flasher::set_flash("Ups...", "Username Atau Password Salah!", "error");
                header("Location: " . BASEURL . "/admin/auth");
                exit;
            }
        } else {
            Flasher::set_flash("Ups...", "Username Tidak Terdaftar!", "warning");
            header("Location: " . BASEURL . "/admin/auth");
            exit;
        }
    }
}
