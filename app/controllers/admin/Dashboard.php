<?php
class Dashboard extends Controller
{

    public function __construct()
    {
        if (!isLogin()) header("Location: " . BASEURL . "/admin/auth");
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
            "title" => "Beranda",
            "marker" => ["active"]
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/index", $data);
        $this->AdminView("templates/footer");
    }

    public function metodepembayaran()
    {
        $data = [
            "title" => "Beranda",
            "marker" => ["active"],
            "metode_bayar" => $this->model("Rekening_Model")->get_all_payment_methods()
        ];

        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/metodepembayaran", $data);
        $this->AdminView("templates/footer");
    }

    public function addpaymentmethod()
    {
        if ($this->model("Rekening_Model")->add_payment_method($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Menambahkan Data Metode Pembayaran!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/metodepembayaran");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menambahkan Data Metode Pembayaran!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/metodepembayaran");
            exit;
        }
    }

    public function getpaymentmethodjson()
    {
        echo json_encode($this->model("Rekening_Model")->get_payment_method_by_id($_POST["id"]));
    }

    public function editpaymentmethod()
    {
        if ($this->model("Rekening_Model")->edit_payment_method($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Memperbarui Data Metode Pembayaran!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/metodepembayaran");
            exit;
        } else {
            Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "warning");
            header("Location: " . BASEURL . "/admin/dashboard/metodepembayaran");
            exit;
        }
    }

    public function deletepaymentmethod($url)
    {
        if ($this->model("Rekening_Model")->delete_payment_method($url) > 0) {
            Flasher::set_flash("Berhasil", "Menghapus Data Metode Pembayaran!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/metodepembayaran");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menghapus Data Metode Pembayaran", "error");
            header("Location: " . BASEURL . "/admin/dashboard/metodepembayaran");
            exit;
        }
    }

    public function dataakun()
    {
        $data = [
            "title" => "Data Akun",
            "marker" => [null, "active"],
            "akun_pengguna" => $this->model("User_Model")->get_all_users()
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/dataakun", $data);
        $this->AdminView("templates/footer");
    }

    public function getdataakunjson()
    {
        echo json_encode($this->model("User_Model")->get_data_user_by_username($_POST["username"]));
    }

    public function editdataakun()
    {
        if ($this->model("User_Model")->update_status_akun_pengguna($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Memperbarui Status Akun Pengguna!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/dataakun");
            exit;
        } else {
            Flasher::set_flash("Ups..", "Anda Tidak Melakukan Perubahan Apapun!", "warning");
            header("Location: " . BASEURL . "/admin/dashboard/dataakun");
            exit;
        }
    }

    public function databooking()
    {
        $data = [
            "title" => "Data Booking",
            "marker" => [null, null, "active"]
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/databooking", $data);
        $this->AdminView("templates/footer");
    }

    public function datajadwal()
    {
        $data = [
            "title" => "Data Jadwal",
            "marker" => [null, null, null, "active"],
            "jadwal" => $this->model("Jadwal_Model")->get_all_jadwal(),
            "hari" => [
                "Monday" => "Senin",
                "Tuesday" => "Selasa",
                "Wednesday" => "Rabu",
                "Thursday" => "Kamis",
                "Friday" => "Jumat",
                "Saturday" => "Sabtu",
                "Sunday" => "Minggu"
            ]
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/datajadwal", $data);
        $this->AdminView("templates/footer");
    }

    public function addjadwal()
    {
        if ($this->model("Jadwal_Model")->add_jadwal($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Menambahkan Data Jadwal!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/datajadwal");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menambahkan Data Jadwal!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/datajadwal");
            exit;
        }
    }

    public function editjadwal()
    {
        if ($this->model("Jadwal_Model")->edit_jadwal($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Memperbarui Data Jadwal!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/datajadwal");
            exit;
        } else {
            Flasher::set_flash("Ups..", "Anda Tidak Melakukan Perubahan Apapun!", "warning");
            header("Location: " . BASEURL . "/admin/dashboard/datajadwal");
            exit;
        }
    }

    public function getjadwaljson()
    {
        echo json_encode($this->model("Jadwal_Model")->get_jadwal_by_id($_POST["id"]));
    }

    public function deletejadwal($url)
    {
        if ($this->model("Jadwal_Model")->delete_jadwal($url) > 0) {
            Flasher::set_flash("Berhasil", "Menghapus Data Jadwal!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/datajadwal");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menghapus Data Jadwal!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/datajadwal");
            exit;
        }
    }

    public function datalapangan()
    {
        $data = [
            "title" => "Data Lapangan",
            "marker" => [null, null, null, null, "active"],
            "lapangan" => $this->model("Lapangan_Model")->get_all_lapangan()
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/datalapangan", $data);
        $this->AdminView("templates/footer");
    }

    public function addlapangan()
    {
        if ($this->model("Lapangan_Model")->add_lapangan($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Menambahkan Data Lapangan!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/datalapangan");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menambahkan Data Lapangan!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/datalapangan");
            exit;
        }
    }

    public function editlapangan()
    {
        if ($this->model("Lapangan_Model")->edit_lapangan($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Memperbarui Data Lapangan!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/datalapangan");
            exit;
        } else {
            Flasher::set_flash("Ups..", "Anda Tidak Melakukan Perubahan Apapun!", "warning");
            header("Location: " . BASEURL . "/admin/dashboard/datalapangan");
            exit;
        }
    }

    public function getlapanganjson()
    {
        echo json_encode($this->model("Lapangan_Model")->get_lapangan_by_id($_POST["id"]));
    }

    public function datamember()
    {
        $data = [
            "title" => "Data Member",
            "marker" => [null, null, null, null, null, "active"],
            "member" => $this->model("Trans_Member_Model")->get_detail_trans_members()
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/datamember", $data);
        $this->AdminView("templates/footer");
    }

    public function confirmdatamember()
    {
        if ($this->model("Trans_Member_Model")->update_status_member($_POST) > 0) {
            if ($this->model("User_Model")->update_status_member($_POST) > 0) {
                Flasher::set_flash("Berhasil", "Memperbarui Status Member User!", "success");
                header("Location: " . BASEURL . "/admin/dashboard/datamember");
                exit;
            }
        } else {
            Flasher::set_flash("Gagal", "Memperbarui Status Member User!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/datamember");
            exit;
        }
    }

    public function getdetailtransjson()
    {
        echo json_encode($this->model("Trans_Member_Model")->get_trans_member_by_id($_POST["id"]));
    }

    public function paketmember()
    {
        $data = [
            "title" => "Data Paket Member",
            "marker" => [null, null, null, null, null, null, "active"],
            "member" => $this->model("Member_Model")->get_all_members()
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/paketmember", $data);
        $this->AdminView("templates/footer");
    }

    public function addpaketmember()
    {
        if ($this->model("Member_Model")->add_member($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Menambahkan Data Paket Member!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/paketmember");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menambahkan Data Paket Member!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/paketmember");
            exit;
        }
    }

    public function editpaketmember()
    {
        if ($this->model("Member_Model")->edit_member($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Memperbarui Data Paket Member!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/paketmember");
            exit;
        } else {
            Flasher::set_flash("Upss..", "Anda Tidak Melakukan Perubahan Apapun!", "warning");
            header("Location: " . BASEURL . "/admin/dashboard/paketmember");
            exit;
        }
    }

    public function deletepaketmember($url)
    {
        //add validation whether the data is used or not
        if ($this->model("Member_Model")->delete_member($url) > 0) {
            Flasher::set_flash("Berhasil", "Menghapus Data Paket Member!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/paketmember");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menghapus Data Paket Member!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/paketmember");
            exit;
        }
    }

    public function getpaketmemberjson()
    {
        echo json_encode($this->model("Member_Model")->get_member_by_id($_POST["id"]));
    }

    public function laporanbooking()
    {
        $data = [
            "title" => "Laporan Booking",
            "marker" => [null, null, null, null, null, null, null, "active"]
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/laporanbooking", $data);
        $this->AdminView("templates/footer");
    }

    public function laporanmember()
    {
        $data = [
            "title" => "Laporan Member",
            "marker" => [null, null, null, null, null, null, null, null, "active"]
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/laporanmember", $data);
        $this->AdminView("templates/footer");
    }

    public function informasi()
    {
        $data = [
            "title" => "Informasi",
            "marker" => [null, null, null, null, null, null, null, null, null, "active"],
            "informations" => $this->model("Informasi_Model")->get_all_informations()
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/informasi", $data);
        $this->AdminView("templates/footer");
    }

    public function addinform()
    {
        if ($this->model("Informasi_Model")->add_inform($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Menambahkan Data Informasi!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/informasi");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menambahkan Data Informasi!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/informasi");
            exit;
        }
    }

    public function getinformbyidjson()
    {
        $raw_inform = $this->model("Informasi_Model")->get_inform_by_id($_POST["id"]);
        $isi_formatted = str_replace('<br />', '', $raw_inform["isi"]);
        $informasi = [
            "judul" => $raw_inform["judul"],
            "isi" => $isi_formatted
        ];
        echo json_encode($informasi);
    }

    public function editinform()
    {
        if ($this->model("Informasi_Model")->edit_inform($_POST) > 0) {
            Flasher::set_flash("Berhasil", "Memperbarui Data Informasi!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/informasi");
            exit;
        } else {
            Flasher::set_flash("Ups..", "Anda Tidak Melakukan Perubahan Apapun!", "warning");
            header("Location: " . BASEURL . "/admin/dashboard/informasi");
            exit;
        }
    }

    public function deleteinform($url)
    {
        if ($this->model("Informasi_Model")->delete_inform($url) > 0) {
            Flasher::set_flash("Berhasil", "Menghapus Data Informasi!", "success");
            header("Location: " . BASEURL . "/admin/dashboard/informasi");
            exit;
        } else {
            Flasher::set_flash("Gagal", "Menghapus Data Informasi!", "error");
            header("Location: " . BASEURL . "/admin/dashboard/informasi");
            exit;
        }
    }

    public function pegawai()
    {
        $data = [
            "title" => "Beranda",
            "marker" => [null, null, null, null, null, null, null, null, null, null, "active"]
        ];

        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/pegawai", $data);
        $this->AdminView("templates/footer");
    }

    public function cetakbooking()
    {
        $this->Reporting("laporanbooking");
    }

    public function logout()
    {
        unset($_SESSION["login"], $_SESSION["id_admin"], $_SESSION["admin"], $_SESSION["nama_admin"], $_SESSION["role"]);
        Flasher::set_flash("Terima kasih", "Telah Bekerja!", "info");
        header("Location: " . BASEURL . "/admin/auth");
        exit;
    }
}
