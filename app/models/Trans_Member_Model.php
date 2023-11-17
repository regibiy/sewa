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
        $sql = "SELECT *, transaksi_member.id AS member_id, akun_pengguna.id AS user_id 
        FROM transaksi_member INNER JOIN akun_pengguna ON transaksi_member.id_user = akun_pengguna.id";
        $this->db->query($sql);
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

    public function add_trans_member($data, $bukti_bayar)
    {
        $sql = "INSERT INTO transaksi_member (tanggal_transaksi, no_transaksi, paket_member, berlaku_sampai, status_transaksi, bukti_bayar) VALUES (:tanggal_transaksi, :no_transaksi, :paket_member, :berlaku_sampai, :status, :bukti_bayar)";
        $this->db->query($sql);
        $this->db->bind("tanggal_transaksi", $data["tanggal"]);
        $this->db->bind("no_transaksi", $data["no_transaksi"]);
        $this->db->bind("paket_member", $data["jenis_paket"]);
        $this->db->bind("berlaku_sampai", $data["berlaku_sampai"]);
        $this->db->bind("status", "Menunggu");
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
