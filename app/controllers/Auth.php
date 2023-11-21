<?php
class Auth extends Controller
{

    public function __construct()
    {
        if (isLogin()) header("Location: " . BASEURL . "/dashboard");
    }

    public function index()
    {
        $data = [
            "title" => "Login"
        ];
        $this->UserView("templates/header", $data);
        $this->UserView("auth/index", $data);
        $this->UserView("templates/footer");
    }

    public function loginprocess()
    {
        if ($this->model("User_Model")->get_user_by_username($_POST["username"]) > 0) {
            $user_data = $this->model("User_Model")->get_data_user_by_username($_POST["username"]);
            if ($user_data["password"] === $_POST["password"]) {
                if ($user_data["status_akun"] === "Aktif") {
                    $_SESSION["login"] = "login";
                    $_SESSION["id_user"] = $user_data["id"];
                    $_SESSION["user"] = $user_data["username"];
                    $_SESSION["nama_user"] = $user_data["nama"];
                    $_SESSION["status_member"] = $user_data["status_member"];
                    if ($_SESSION["status_member"] === "Member") {
                        $total_book = $this->model("Trans_Member_Model")->get_count_book_by_id($_SESSION["id_user"]);
                        $sisa_guna = 4 - $total_book["total_book"]; // 4 didapat dari ketentuan batas booking member
                        if ($sisa_guna === 0) {
                            if ($id_transaksi = $this->model("Trans_Member_Model")->get_status_trans($_SESSION["id_user"])) {
                                $this->model("Trans_Member_Model")->update_status_member_dua($id_transaksi["id"]);
                                $this->model("User_Model")->update_status_member_dua($_SESSION["id_user"]);
                            }
                        }
                    }
                    Flasher::set_flash("Login", "Berhasil!", "success");
                    header("Location: " . BASEURL . "/dashboard");
                    exit;
                } else {
                    Flasher::set_flash("Ups...", "Akun Anda Di-suspend!", "error");
                    header("Location: " . BASEURL . "/auth");
                    exit;
                }
            } else {
                $data_input = [
                    "username" => $_POST["username"]
                ];
                Flasher::set_data_input($data_input);
                Flasher::set_flash("Ups...", "Username Atau Password Salah!", "error");
                header("Location: " . BASEURL . "/auth");
                exit;
            }
        } else {
            Flasher::set_flash("Ups...", "Username Tidak Terdaftar!", "warning");
            header("Location: " . BASEURL . "/auth");
            exit;
        }
    }

    public function register()
    {
        $data = [
            "title" => "Register"
        ];
        $this->UserView("templates/header", $data);
        $this->UserView("auth/register", $data);
        $this->UserView("templates/footer");
    }

    public function registrationprocess()
    {
        if ($this->model("User_Model")->get_user_by_username($_POST["username"]) > 0) {
            $arr_data_input = [
                "nama" => $_POST["nama"],
                "email" => $_POST["email"],
                "jenis_kelamin" => $_POST["jenis_kelamin"],
                "no_telp" => $_POST["no_telp"]
            ];
            Flasher::set_data_input($arr_data_input);
            Flasher::set_flash("Ups...", "Username Telah Digunakan!", "warning");
            header("Location: " . BASEURL . "/auth/register");
            exit;
        } else {
            if ($this->model("User_Model")->add_user($_POST) > 0) {
                Flasher::set_flash("Pendaftaran", "Berhasil Dilakukan!", "success");
                header("Location: " . BASEURL . "/auth");
                exit;
            } else {
                Flasher::set_flash("Pendaftaran", "Gagal Dilakukan!", "error");
                header("Location: " . BASEURL . "/auth/register");
                exit;
            }
        }
    }
}
