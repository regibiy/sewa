<?php
class Auth extends Controller
{

    public function __construct()
    {
        if (isLoginAdmin()) header("Location: " . BASEURL . "/admin/dashboard");
        $data = $this->model("Trans_Member_Model")->get_all_trans_members_dua();
        foreach ($data as $item) {
            if (date("Y-m-d") === $item["berlaku_sampai"]) {
                $this->model("Trans_Member_Model")->update_status_member_dua($item["member_id"]);
                $this->model("User_Model")->update_status_member_dua($item["user_id"]);
            }
        }
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
                    $_SESSION["login_admin"] = "login";
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
