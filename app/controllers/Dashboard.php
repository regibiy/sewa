<?php
class Dashboard extends Controller
{
    private $user_data;

    public function __construct()
    {
        if (!isLogin()) header("Location: " . BASEURL . "/auth");
        $this->user_data = $this->model("User_Model")->get_data_user_by_username($_SESSION["user"]);
    }

    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "marker" => ["active", null, null, null, null, null]
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/index", $data);
        $this->UserView("templates/footer");
    }

    public function profil()
    {
        $data = [
            "title" => "Profil Anda",
            "marker" => ["active", null, null, null, null, null],
            "data_user" => $this->user_data
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/profil", $data);
        $this->UserView("templates/footer");
    }

    public function ubahprofil()
    {
        if ($this->model("User_Model")->edit_user($_POST) > 0) {
            $temp = $this->model("User_Model")->get_data_user_by_username($_POST["username"]);
            $_SESSION["user"] = $temp["username"];
            $_SESSION["nama_user"] = $temp["nama"];
            Flasher::set_flash("Berhasil", "Memperbarui Data!", "success");
            header("Location: " . BASEURL . "/dashboard/profil");
            exit;
        } else {
            Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "info");
            header("Location: " . BASEURL . "/dashboard/profil");
            exit;
        }
    }

    public function ubahpassword()
    {
        $old_pass = $this->user_data["password"];
        if ($_POST["old_password"] === $old_pass) {
            if ($this->model("User_Model")->edit_password($_POST) > 0) {
                unset($_SESSION["login"], $_SESSION["user"], $_SESSION["nama_user"], $_SESSION["status_member"]);
                Flasher::set_flash("Berhasil", "Mengubah Password! Silakan Login Kembali.", "info");
                header("Location: " . BASEURL . "/auth");
                exit;
            } else {
                Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "info");
                header("Location: " . BASEURL . "/dashboard/profil");
                exit;
            }
        } else {
            Flasher::set_flash("Upss...", "Password Lama Anda Tidak Sama!", "warning");
            header("Location: " . BASEURL . "/dashboard/profil");
            exit;
        }
    }

    public function informasi()
    {
        $data = [
            "title" => "Informasi",
            "marker" => [null, null, null, null, null, "active"]
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/informasi");
        $this->UserView("templates/footer");
    }

    public function booking()
    {
        $data = [
            "title" =>  "Booking",
            "marker" => [null, "active", null, null, null, null],
            "lapangan" => $this->model("Lapangan_Model")->get_all_lapangan()
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/booking", $data);
        $this->UserView("templates/footer");
    }

    public function bookingprocess()
    {
        if ($this->model("Booking_Model")->add_booking($_POST) > 0) {
            Flasher::set_flash("Terima Kasih", "Booking Berhasil Dilakukan. Segera Upload Bukti Pembayaran!", "success");
            header("Location: " . BASEURL . "/dashboard/datasewa");
            exit;
        }
    }

    public function member()
    {
        $data = [
            "title" =>  "Data Booking",
            "marker" => [null, null, "active", null, null, null]
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/member");
        $this->UserView("templates/footer");
    }

    public function membersuccess()
    {
        $data = [
            "title" =>  "Member Sukses",
            "marker" => [null, null, "active", null, null, null]
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/membersuccess");
        $this->UserView("templates/footer");
    }

    public function databooking()
    {
        $data = [
            "title" =>  "Data Booking",
            "marker" => [null, null, null, "active", null, null],
            "lapangan" => $this->model("Lapangan_Model")->get_all_lapangan()
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/databooking", $data);
        $this->UserView("templates/footer");
    }

    public function datasewa()
    {
        $data = [
            "title" =>  "Data Booking",
            "marker" => [null, null, null, null, "active", null],
            "payment_method" => $this->model("Rekening_Model")->get_all_payment_methods(),
            "data_booking" => $this->model("Booking_Model")->data_booking_user($_SESSION["id_user"])
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/datasewa", $data);
        $this->UserView("templates/footer");
    }

    public function logout()
    {
        unset($_SESSION["login"], $_SESSION["id_user"], $_SESSION["user"], $_SESSION["nama_user"], $_SESSION["status_member"]);
        Flasher::set_flash("Terima Kasih", "Telah Berkunjung!", "info");
        header("Location: " . BASEURL . "/auth");
    }
}
