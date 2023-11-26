<?php
class Dashboard extends Controller
{
    private $user_data;

    public function __construct()
    {
        if (!isLoginUser()) header("Location: " . BASEURL . "/auth");
        $this->user_data = $this->model("User_Model")->get_data_user_by_username($_SESSION["user"]);
        if ($_SESSION["status_member"] === "Member") {
            $status = $this->model("Trans_Member_Model")->get_status_trans($_SESSION["id_user"]);
            $total_book = $this->model("Trans_Member_Model")->get_count_book_by_id_debug($_SESSION["id_user"], $status["no_transaksi"]);
            $sisa_guna = 4 - $total_book["total_book"];
            if ($sisa_guna === 0) {
                if ($id_transaksi = $this->model("Trans_Member_Model")->get_status_trans($_SESSION["id_user"])) {
                    $this->model("Trans_Member_Model")->update_status_member_dua($id_transaksi["id"]);
                    $this->model("User_Model")->update_status_member_dua($_SESSION["id_user"]);
                }
            }
            $_SESSION["status_member"] = $this->user_data["status_member"];
        }
    }

    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "marker" => ["active"]
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/index", $data);
        $this->UserView("templates/footer");
    }

    public function profil($url)
    {
        $data = [
            "title" => "Profil Anda",
            "marker" => ["active"],
            "data_user" => $this->user_data,
            "url" => $url,
            "history_beli" => $this->model("Trans_Member_Model")->get_detail_trans_member($_SESSION["id_user"])
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/profil", $data);
        $this->UserView("templates/footer");
    }

    public function getdetailmemberjson()
    {
        echo json_encode($this->model("Trans_Member_Model")->get_trans_member_by_id($_POST["id"]));
    }

    public function ubahprofil()
    {
        if ($this->model("User_Model")->edit_user($_POST) > 0) {
            $temp = $this->model("User_Model")->get_data_user_by_username($_POST["username"]);
            $_SESSION["user"] = $temp["username"];
            $_SESSION["nama_user"] = $temp["nama"];
            Flasher::set_flash("Berhasil", "Memperbarui Data!", "success");
            header("Location: " . BASEURL . "/dashboard/profil/0");
            exit;
        } else {
            Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "info");
            header("Location: " . BASEURL . "/dashboard/profil/0");
            exit;
        }
    }

    public function ubahpassword()
    {
        $old_pass = $this->user_data["password"];
        if ($_POST["old_password"] === $old_pass) {
            if ($this->model("User_Model")->edit_password($_POST) > 0) {
                unset($_SESSION["login"], $_SESSION["id_user"], $_SESSION["user"], $_SESSION["nama_user"], $_SESSION["status_member"]);
                Flasher::set_flash("Berhasil", "Mengubah Password! Silakan Login Kembali.", "info");
                header("Location: " . BASEURL . "/auth");
                exit;
            } else {
                Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "info");
                header("Location: " . BASEURL . "/dashboard/profil/0");
                exit;
            }
        } else {
            Flasher::set_flash("Upss...", "Password Lama Anda Tidak Sama!", "warning");
            header("Location: " . BASEURL . "/dashboard/profil/0");
            exit;
        }
    }

    public function informasi()
    {
        $data = [
            "title" => "Informasi",
            "marker" => [null, null, null, null, null, "active"],
            "informations" => $this->model("Informasi_Model")->get_all_informations()
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/informasi", $data);
        $this->UserView("templates/footer");
    }

    public function booking()
    {
        $data = [
            "title" =>  "Booking",
            "marker" => [null, "active"],
            "lapangan" => $this->model("Lapangan_Model")->get_all_lapangan()
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/booking", $data);
        $this->UserView("templates/footer");
    }

    public function checkbeforebooking()
    {
        echo json_encode($this->model("Trans_Member_Model")->get_status_trans($_SESSION["id_user"]));
    }

    public function bookingprocess()
    {
        if ($this->model("Booking_Model")->check_booking($_POST) > 0) {
            Flasher::set_flash("Upss..", "Jadwal Yang Anda Pilih Tidak Tersedia Karena Pengguna Lain. Silakan Memilih Jadwal Lain!", "error");
            header("Location: " . BASEURL . "/dashboard/booking");
            exit;
        } else {
            if ($this->model("Booking_Model")->add_booking($_POST, $_SESSION["status_member"]) > 0) {
                if ($_SESSION["status_member"] === "Member") {
                    $status = $this->model("Trans_Member_Model")->get_status_trans($_SESSION["id_user"]);
                    $total_book = $this->model("Trans_Member_Model")->get_count_book_by_id_debug($_SESSION["id_user"], $status["no_transaksi"]);
                    $sisa_guna = 4 - $total_book["total_book"];
                    if ($sisa_guna === 0) {
                        if ($id_transaksi = $this->model("Trans_Member_Model")->get_status_trans($_SESSION["id_user"])) {
                            $this->model("Trans_Member_Model")->update_status_member_dua($id_transaksi["trans_member_id"]);
                            $this->model("User_Model")->update_status_member_dua($_SESSION["id_user"]);
                        }
                    }
                    $_SESSION["status_member"] = $this->user_data["status_member"];
                }
                Flasher::set_flash("Terima Kasih", "Booking Berhasil Dilakukan. Segera Upload Bukti Pembayaran JIKA Anda Bukan Member!", "success");
                header("Location: " . BASEURL . "/dashboard/datasewa");
                exit;
            }
        }
    }

    public function member()
    {
        $data = [
            "title" =>  "Data Booking",
            "marker" => [null, null, "active"],
            "status_member" => $_SESSION["status_member"],
            "paket_member" => $this->model("Member_Model")->get_all_members(),
            "metode_bayar" => $this->model("Rekening_Model")->get_all_payment_methods()
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/member", $data);
        $this->UserView("templates/footer");
    }

    public function getpaketmemberjson()
    {
        echo json_encode($this->model("Member_Model")->get_member_by_id($_POST["id"]));
    }

    public function memberprocess()
    {
        $id_user = $_SESSION["id_user"];
        $bukti_bayar = upload_image($_FILES["bukti_bayar"]["name"], $_FILES["bukti_bayar"]["size"], $_FILES["bukti_bayar"]["tmp_name"], "../public/img/evidence/");
        if ($bukti_bayar) {
            if ($this->model("Trans_Member_Model")->add_trans_member($_POST, $id_user, $bukti_bayar) > 0) {
                Flasher::set_flash("Terima kasih", "Telah Menjadi Member Gor Unipol. Data Anda Akan Segera Diproses Oleh Admin Kami!", "success");
                header("Location: " . BASEURL . "/dashboard/profil/1");
                exit;
            } else {
                Flasher::set_flash("Upss..", "Gagal Melakukan Transaksi Member!", "error");
                header("Location: " . BASEURL . "/dashboard/1");
                exit;
            }
        } else {
            Flasher::set_flash("Upss..", "Gagal Mengunggah Bukti Pembayaran! Pastikan File Berekstensi .jpg, .jpeg atau .png Dan Berukuran Kurang Dari 3MB", "error");
            header("Location: " . BASEURL . "/dashboard/member");
            exit;
        }
    }

    public function membersuccess()
    {
        $status = $this->model("Trans_Member_Model")->get_status_trans($_SESSION["id_user"]);
        $tanggal_berlaku = new DateTime($status["berlaku_sampai"]);
        $selisih = $tanggal_berlaku->diff(new DateTime());
        $sisa_hari = $selisih->days;
        $total_book = $this->model("Trans_Member_Model")->get_count_book_by_id_debug($_SESSION["id_user"], $status["no_transaksi"]);
        $sisa_guna = 4 - $total_book["total_book"];
        $data = [
            "title" =>  "Member Sukses",
            "marker" => [null, null, "active"],
            "sisa_hari" => $sisa_hari,
            "sisa_guna" => $sisa_guna
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/membersuccess", $data);
        $this->UserView("templates/footer");
    }

    public function databooking()
    {
        $data = [
            "title" =>  "Data Booking",
            "marker" => [null, null, null, "active"],
            "status_booking" => ["Dibatalkan", "Selesai"],
            "current_book" => $this->model("Lapangan_Model")->get_current_booking()
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
            "marker" => [null, null, null, null, "active"],
            "payment_method" => $this->model("Rekening_Model")->get_all_payment_methods(),
            "data_booking" => $this->model("Booking_Model")->data_booking_user($_SESSION["id_user"])
        ];

        $this->UserView("templates/header", $data);
        $this->UserView("templates/sidebar", $data);
        $this->UserView("dashboard/datasewa", $data);
        $this->UserView("templates/footer");
    }

    public function getdetailbookingjson()
    {
        echo json_encode($this->model("Booking_Model")->detail_booking_by_id($_POST["id"]));
    }

    public function cetakbooking($url)
    {
        $data = [
            "detail_booking" => $this->model("Booking_Model")->detail_booking_by_id($url),
            "nama" => $_SESSION["nama_user"],
            "status" => $_SESSION["status_member"]
        ];
        $this->Reporting("cetakbookinguser", $data);
    }

    public function uploadbuktibayar()
    {
        $data = $this->model("Booking_Model")->detail_booking_by_id($_POST["id"]);
        if ($data["bukti_bayar"] !== null) unlink("../public/img/evidence/" . $data["bukti_bayar"]);

        $bukti_bayar = upload_image($_FILES["bukti_bayar"]["name"], $_FILES["bukti_bayar"]["size"], $_FILES["bukti_bayar"]["tmp_name"], "../public/img/evidence/");
        if ($bukti_bayar) {
            if ($this->model("Booking_Model")->update_bukti_bayar($_POST, $bukti_bayar) > 0) {
                Flasher::set_flash("Terima kasih", "Bukti Pembayaran Berhasil Diunggah! Silakan Menuju Ke Gor Unipol Sesuai Jadwal Anda!", "success");
                header("Location: " . BASEURL . "/dashboard/datasewa");
                exit;
            } else {
                Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "info");
                header("Location: " . BASEURL . "/dashboard/datasewa");
                exit;
            }
        } else {
            Flasher::set_flash("Upss..", "Gagal Mengunggah Bukti Pembayaran! Pastikan File Berekstensi .jpg, .jpeg atau .png Dan Berukuran Kurang Dari 3MB", "error");
            header("Location: " . BASEURL . "/dashboard/datasewa");
            exit;
        }
    }

    public function uploadbuktibayarmember()
    {
        $data = $this->model("Trans_Member_Model")->get_trans_member_by_id($_POST["id"]);
        if ($data["bukti_bayar"] !== null) unlink("../public/img/evidence/" . $data["bukti_bayar"]);

        $bukti_bayar = upload_image($_FILES["bukti_bayar"]["name"], $_FILES["bukti_bayar"]["size"], $_FILES["bukti_bayar"]["tmp_name"], "../public/img/evidence/");
        if ($bukti_bayar) {
            if ($this->model("Trans_Member_Model")->update_bukti_bayar($_POST, $bukti_bayar) > 0) {
                Flasher::set_flash("Terima kasih", "Bukti Pembayaran Berhasil Diunggah! Data Anda Akan Segera Diproses Oleh Admin Kami!", "success");
                header("Location: " . BASEURL . "/dashboard/profil/1");
                exit;
            } else {
                Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "info");
                header("Location: " . BASEURL . "/dashboard/profil/1");
                exit;
            }
        } else {
            Flasher::set_flash("Upss..", "Gagal Mengunggah Bukti Pembayaran! Pastikan File Berekstensi .jpg, .jpeg atau .png Dan Berukuran Kurang Dari 3MB", "error");
            header("Location: " . BASEURL . "/dashboard/profil/1");
            exit;
        }
    }

    public function cancelmember($url)
    {
        if ($this->model("Trans_Member_Model")->cancel_member($url)) {
            Flasher::set_flash("Pembatalan Berhasil!", "Terima Kasih Telah Mengunjungi Web Gor Unipol.", "success");
            header("Location: " . BASEURL . "/dashboard/profil/1");
            exit;
        } else {
            Flasher::set_flash("Upss..", "Anda Sudah Melakukan Pembatalan Member!", "error");
            header("Location: " . BASEURL . "/dashboard/profil/1");
            exit;
        }
    }

    public function cancelbooking($url)
    {
        //add validation when status member change
        if ($this->model("Booking_Model")->cancel_booking($url)) {
            Flasher::set_flash("Pembatalan Berhasil!", "Terima Kasih Telah Melakukan Booking Di Web Gor Unipol", "success");
            header("Location: " . BASEURL . "/dashboard/datasewa");
            exit;
        } else {
            Flasher::set_flash("Upss..", "Anda Sudah Melakukan Pembatalan Booking!", "error");
            header("Location: " . BASEURL . "/dashboard/datasewa");
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION["login"], $_SESSION["id_user"], $_SESSION["user"], $_SESSION["nama_user"], $_SESSION["status_member"]);
        Flasher::set_flash("Terima Kasih", "Telah Berkunjung!", "info");
        header("Location: " . BASEURL . "/auth");
        exit;
    }
}
