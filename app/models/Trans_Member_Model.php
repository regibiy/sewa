<?php
class Trans_Member_Model
{
    private $table = "transaksi_member";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_trans_members()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_all_trans_members_dua()
    {
        $sql = "SELECT *, transaksi_member.id AS member_id, akun_pengguna.id AS user_id FROM transaksi_member 
        INNER JOIN akun_pengguna ON transaksi_member.id_user = akun_pengguna.id
        INNER JOIN member ON transaksi_member.paket_member = member.id";
        $this->db->query($sql);
        return $this->db->result_set();
    }

    public function get_report_trans_member_by_period($data)
    {
        $sql = "SELECT * FROM transaksi_member 
        INNER JOIN akun_pengguna ON transaksi_member.id_user = akun_pengguna.id
        INNER JOIN member ON transaksi_member.paket_member = member.id 
        WHERE tanggal_transaksi BETWEEN :tanggal_awal AND :tanggal_akhir";
        $this->db->query($sql);
        $this->db->bind("tanggal_awal", $data["tanggal_awal"]);
        $this->db->bind("tanggal_akhir", $data["tanggal_akhir"]);
        return $this->db->result_set();
    }

    public function get_trans_member_by_id($id)
    {
        $sql = "SELECT * FROM transaksi_member
        INNER JOIN akun_pengguna ON transaksi_member.id_user = akun_pengguna.id
        WHERE transaksi_member.id=:id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function get_detail_trans_member($id)
    {
        $sql = "SELECT *, transaksi_member.id AS member_id, member.id AS paket_member_id FROM transaksi_member 
        INNER JOIN member ON transaksi_member.paket_member = member.id
        WHERE id_user= :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        return $this->db->result_set();
    }

    public function get_detail_trans_members()
    {
        $sql = "SELECT *, transaksi_member.id AS member_id, member.id AS paket_member_id, akun_pengguna.id AS id_akun FROM transaksi_member 
        INNER JOIN member ON transaksi_member.paket_member = member.id
        INNER JOIN akun_pengguna ON transaksi_member.id_user = akun_pengguna.id
        WHERE status_transaksi = :status_transaksi";
        $this->db->query($sql);
        $this->db->bind("status_transaksi", "Menunggu");
        return $this->db->result_set();
    }

    public function get_status_trans($id)
    {
        $sql = "SELECT *, transaksi_member.id AS trans_member_id FROM transaksi_member INNER JOIN member ON transaksi_member.paket_member = member.id WHERE id_user = :id AND status_transaksi = :status_transaksi";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->bind("status_transaksi", "Aktif");
        return $this->db->single();
    }

    public function get_count_book_by_id_debug($id, $no_trans_member)
    {
        $sql = "SELECT COUNT(booking.no_transaksi) AS total_book FROM booking 
        WHERE booking.id_user = :id AND no_trans_member = :no_trans_member
        AND status_booking NOT IN (:status_booking)";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->bind("no_trans_member", $no_trans_member);
        $this->db->bind("status_booking", "Dibatalkan");
        return $this->db->single();
    }

    public function get_count_notif()
    {
        $sql = "SELECT COUNT(id) AS total_notif FROM transaksi_member WHERE status_transaksi = :status_transaksi";
        $this->db->query($sql);
        $this->db->bind("status_transaksi", "Menunggu");
        return $this->db->single();
    }

    public function get_max_no_trans_member()
    {
        $sql = "SELECT MAX(no_transaksi) AS max_no_trans FROM transaksi_member WHERE tanggal_transaksi = CURRENT_DATE()";
        $this->db->query($sql);
        return $this->db->single();
    }

    public function add_trans_member($data, $id_user, $bukti_bayar)
    {
        $sql = "INSERT INTO transaksi_member (tanggal_transaksi, no_transaksi, id_user, paket_member, berlaku_sampai, status_transaksi, bukti_bayar) VALUES (:tanggal_transaksi, :no_transaksi, :id_user, :paket_member, :berlaku_sampai, :status_transaksi, :bukti_bayar)";
        $this->db->query($sql);
        $this->db->bind("tanggal_transaksi", $data["tanggal"]);
        $this->db->bind("no_transaksi", $data["no_transaksi"]);
        $this->db->bind("id_user", $id_user);
        $this->db->bind("paket_member", $data["jenis_paket"]);
        $this->db->bind("berlaku_sampai", $data["berlaku_sampai"]);
        $this->db->bind("status_transaksi", "Menunggu");
        $this->db->bind("bukti_bayar", $bukti_bayar);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function update_bukti_bayar($data, $gambar)
    {
        $sql = "UPDATE transaksi_member SET bukti_bayar = :bukti_bayar WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("bukti_bayar", $gambar);
        $this->db->bind("id", $data["id"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function update_status_member($data)
    {
        $sql = "UPDATE transaksi_member SET status_transaksi = :status_transaksi WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("status_transaksi", $data["status_transaksi"]);
        $this->db->bind("id", $data["id"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function update_status_member_dua($id)
    {
        $sql = "UPDATE transaksi_member SET status_transaksi = :status_transaksi WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("status_transaksi", "Habis");
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function cancel_member($id)
    {
        $sql = "UPDATE transaksi_member SET status_transaksi = :status_transaksi WHERE id= :id";
        $this->db->query($sql);
        $this->db->bind("status_transaksi", "Dibatalkan");
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->row_count();
    }
}
