<?php
class Dashboard extends Controller
{

    public function __construct()
    {
        if (!isLogin()) header("Location: " . BASEURL . "/admin/auth");
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

    public function dataakun()
    {
        $data = [
            "title" => "Data Akun",
            "marker" => [null, "active"]
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/dataakun", $data);
        $this->AdminView("templates/footer");
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
            "marker" => [null, null, null, null, null, null, null, null, null, "active"]
        ];
        $this->AdminView("templates/header", $data);
        $this->AdminView("templates/sidebar", $data);
        $this->AdminView("dashboard/informasi", $data);
        $this->AdminView("templates/footer");
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
