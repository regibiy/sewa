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

    public function get_trans_member_by_id($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function add_trans_member($data, $bukti_bayar)
    {
        $sql = "INSERT INTO transaksi_member (tanggal_transaksi, no_transaksi, paket_member, berlaku_sampai, status, bukti_bayar) VALUES (:tanggal_transaksi, :no_transaksi, :paket_member, :berlaku_sampai, :status, :bukti_bayar)";
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

    // public function edit_member($data)
    // {
    //     $sql = "UPDATE member SET nama_paket = :nama_paket, hari = :hari, jadwal = :jadwal, keterangan = :keterangan, harga = :harga, status = :status WHERE id = :id";
    //     $this->db->query($sql);
    //     $this->db->bind("nama_paket", $data["nama_paket"]);
    //     $this->db->bind("hari", $data["hari"]);
    //     $this->db->bind("jadwal", $data["sesi"]);
    //     $this->db->bind("keterangan", $data["keterangan"]);
    //     $this->db->bind("harga", $data["harga"]);
    //     $this->db->bind("status", $data["status"]);
    //     $this->db->bind("id", $data["id"]);

    //     $this->db->execute();
    //     return $this->db->row_count();
    // }

    // public function delete_member($id)
    // {
    //     $sql = "DELETE FROM member WHERE id = :id";
    //     $this->db->query($sql);
    //     $this->db->bind("id", $id);

    //     $this->db->execute();
    //     return $this->db->row_count();
    // }
}
