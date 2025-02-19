<?php
class Booking_Model
{
    private $table = "booking";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_booking()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_booking_by_no_trans($no_trans)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE no_transaksi = :no_trans");
        $this->db->bind("no_trans", $no_trans);
        return $this->db->single();
    }

    public function get_latest_all_booking()
    {
        $sql = "SELECT * FROM booking 
        INNER JOIN lapangan ON booking.lapangan = lapangan.id
        INNER JOIN jadwal ON booking.jadwal = jadwal.sesi AND DAYNAME(booking.tanggal_sewa) = jadwal.hari
        WHERE status_booking NOT IN (:status_booking, :batal) AND tanggal_sewa >= CURRENT_DATE()";
        $this->db->query($sql);
        $this->db->bind("status_booking", "Selesai");
        $this->db->bind("batal", "Dibatalkan");
        return $this->db->result_set();
    }

    public function get_count_notif()
    {
        $sql = "SELECT COUNT(no_transaksi) AS total_notif FROM booking WHERE status_booking = :status_booking";
        $this->db->query($sql);
        $this->db->bind("status_booking", "Menunggu");
        return $this->db->single();
    }

    public function get_booking_report()
    {
        $sql = "SELECT no_transaksi, kode_booking, lapangan.nama_lapangan, tanggal_sewa, booking.jadwal, jadwal.harga, jam_mulai, jam_selesai, booking.status_booking, status_member_when_book, bukti_bayar FROM booking 
        INNER JOIN lapangan ON booking.lapangan = lapangan.id
        INNER JOIN jadwal ON booking.jadwal = jadwal.sesi AND DAYNAME(booking.tanggal_sewa) = jadwal.hari WHERE booking.status_booking = :status_booking";
        $this->db->query($sql);
        $this->db->bind("status_booking", "Selesai");
        return $this->db->result_set();
    }

    public function get_booking_report_by_period($data)
    {
        $sql = "SELECT no_transaksi, kode_booking, lapangan.nama_lapangan, tanggal_sewa, booking.jadwal, jadwal.harga, jam_mulai, jam_selesai, booking.status_booking, status_member_when_book, bukti_bayar FROM booking 
        INNER JOIN lapangan ON booking.lapangan = lapangan.id
        INNER JOIN jadwal ON booking.jadwal = jadwal.sesi AND DAYNAME(booking.tanggal_sewa) = jadwal.hari WHERE booking.status_booking = :status_booking  AND (tanggal_sewa BETWEEN :tanggal_awal AND :tanggal_akhir)";
        $this->db->query($sql);
        $this->db->bind("status_booking", "Selesai");
        $this->db->bind("tanggal_awal", $data["tanggal_awal"]);
        $this->db->bind("tanggal_akhir", $data["tanggal_akhir"]);
        return $this->db->result_set();
    }

    public function add_booking($data, $status_member)
    {
        $sql = "INSERT INTO booking (no_transaksi, tanggal_booking, kode_booking, id_user, lapangan, tanggal_sewa, jadwal, jam_mulai, jam_selesai, status_booking, status_member_when_book, no_trans_member, bukti_bayar) VALUES (:no_transaksi, :tanggal_booking, :kode_booking, :id_user, :lapangan, :tanggal_sewa, :jadwal, :jam_mulai, :jam_selesai, :status_booking, :status_member_when_book, :no_trans_member, :bukti_bayar)";
        $this->db->query($sql);
        $this->db->bind("no_transaksi", $data["no_transaksi"]);
        $this->db->bind("tanggal_booking", date("Y-m-d"));
        $this->db->bind("kode_booking", $data["kode_booking"]);
        $this->db->bind("id_user", $_SESSION["id_user"]);
        $this->db->bind("lapangan", $data["lapangan"]);
        $this->db->bind("tanggal_sewa", $data["tanggal_sewa"]);
        $this->db->bind("jadwal", $data["jadwal"]);
        $this->db->bind("jam_mulai", $data["jam_mulai"]);
        $this->db->bind("jam_selesai", $data["jam_selesai"]);
        $this->db->bind("status_booking", "Menunggu");
        $this->db->bind("status_member_when_book", $status_member);
        $this->db->bind("no_trans_member", $data["no_trans_member"]);
        $this->db->bind("bukti_bayar", null);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function data_booking_user($id)
    {
        $sql = "SELECT no_transaksi, lapangan.nama_lapangan, tanggal_sewa, jadwal.harga, jam_mulai, jam_selesai, booking.status_booking, status_member_when_book, bukti_bayar FROM booking
        INNER JOIN lapangan ON booking.lapangan = lapangan.id
        INNER JOIN jadwal ON booking.jadwal = jadwal.sesi AND DAYNAME(booking.tanggal_sewa) = jadwal.hari WHERE id_user = :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        return $this->db->result_set();
    }

    public function detail_booking_by_id($no_transaksi)
    {
        $sql = "SELECT no_transaksi, kode_booking, nama, email, jenis_kelamin, no_telp, status_member, lapangan.nama_lapangan, tanggal_sewa, booking.jadwal, jadwal.harga, jam_mulai, jam_selesai, booking.status_booking, status_member_when_book, bukti_bayar FROM booking 
        INNER JOIN lapangan ON booking.lapangan = lapangan.id
        INNER JOIN akun_pengguna ON booking.id_user = akun_pengguna.id
        INNER JOIN jadwal ON booking.jadwal = jadwal.sesi AND DAYNAME(booking.tanggal_sewa) = jadwal.hari WHERE no_transaksi = :no_transaksi";
        $this->db->query($sql);
        $this->db->bind("no_transaksi", $no_transaksi);
        return $this->db->single();
    }

    public function check_booking($data)
    {
        $sql = "SELECT * FROM booking WHERE
          NOT (
            :jam_mulai < jam_mulai AND :jam_selesai <= jam_mulai
            OR :jam_mulai >= jam_selesai AND :jam_selesai > jam_selesai
          ) AND lapangan = :lapangan AND tanggal_sewa = :tanggal_sewa AND status_booking IN ('Menunggu', 'Sedang Dicek', 'Aktif');";
        $this->db->query($sql);
        $this->db->bind("tanggal_sewa", $data["tanggal_sewa"]);
        $this->db->bind("jam_mulai", $data["jam_mulai"] . ":00");
        $this->db->bind("jam_selesai", $data["jam_selesai"] . ":00");
        $this->db->bind("lapangan", $data["lapangan"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function update_bukti_bayar($data, $gambar)
    {
        $sql = "UPDATE booking SET bukti_bayar = :bukti_bayar WHERE no_transaksi = :no_transaksi";
        $this->db->query($sql);
        $this->db->bind("bukti_bayar", $gambar);
        $this->db->bind("no_transaksi", $data["id"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function update_status_booking($data)
    {
        $sql = "UPDATE booking SET status_booking = :status_booking WHERE no_transaksi = :no_transaksi";
        $this->db->query($sql);
        $this->db->bind("status_booking", $data["keterangan"]);
        $this->db->bind("no_transaksi", $data["no_transaksi"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function get_max_no_trans_book()
    {
        $sql = "SELECT MAX(no_transaksi) AS max_no_trans FROM booking WHERE tanggal_booking = CURRENT_DATE()";
        $this->db->query($sql);
        return $this->db->single();
    }

    public function cancel_booking($no_transaksi)
    {
        $sql = "UPDATE booking SET status_booking = :status_booking WHERE no_transaksi = :no_transaksi";
        $this->db->query($sql);
        $this->db->bind("status_booking", "Dibatalkan");
        $this->db->bind("no_transaksi", $no_transaksi);
        $this->db->execute();
        return $this->db->row_count();
    }
}
