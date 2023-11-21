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

    public function get_booking_by_id($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function add_booking($data, $status_member)
    {
        $sql = "INSERT INTO booking (no_transaksi, kode_booking, id_user, lapangan, tanggal_sewa, jadwal, jam_mulai, jam_selesai, status_booking, status_member_when_book, bukti_bayar) VALUES (:no_transaksi, :kode_booking, :id_user, :lapangan, :tanggal_sewa, :jadwal, :jam_mulai, :jam_selesai, :status_booking, :status_member_when_book, :bukti_bayar)";
        $this->db->query($sql);
        $this->db->bind("no_transaksi", $data["no_transaksi"]);
        $this->db->bind("kode_booking", $data["kode_booking"]);
        $this->db->bind("id_user", $_SESSION["id_user"]);
        $this->db->bind("lapangan", $data["lapangan"]);
        $this->db->bind("tanggal_sewa", $data["tanggal_sewa"]);
        $this->db->bind("jadwal", $data["jadwal"]);
        $this->db->bind("jam_mulai", $data["jam_mulai"]);
        $this->db->bind("jam_selesai", $data["jam_selesai"]);
        $this->db->bind("status_booking", "Menunggu");
        $this->db->bind("status_member_when_book", $status_member);
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
        $sql = "SELECT no_transaksi, kode_booking, lapangan.nama_lapangan, tanggal_sewa, booking.jadwal, jadwal.harga, jam_mulai, jam_selesai, booking.status_booking, status_member_when_book, bukti_bayar FROM booking 
        INNER JOIN lapangan ON booking.lapangan = lapangan.id
        INNER JOIN jadwal ON booking.jadwal = jadwal.sesi AND DAYNAME(booking.tanggal_sewa) = jadwal.hari WHERE no_transaksi = :no_transaksi";
        $this->db->query($sql);
        $this->db->bind("no_transaksi", $no_transaksi);
        return $this->db->single();
    }

    public function check_booking($data)
    {
        $sql = "SELECT * FROM booking WHERE
            (:jam_mulai NOT BETWEEN jam_mulai AND jam_selesai
             OR :jam_selesai NOT BETWEEN jam_mulai AND jam_selesai)
            AND lapangan = :lapangan
            AND tanggal_sewa = :tanggal_sewa
            AND status_booking IN ('Menunggu', 'Sedang Dicek', 'Aktif')";
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
