<?php
class Member_Model
{
    private $table = "member";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_members()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_member_by_id($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function add_member($data)
    {
        $sql = "INSERT INTO member (nama_paket, hari, jadwal, keterangan, harga, status_member) VALUES (:nama_paket, :hari, :jadwal, :keterangan, :harga, :status)";
        $this->db->query($sql);
        $this->db->bind("nama_paket", $data["nama_paket"]);
        $this->db->bind("hari", $data["hari"]);
        $this->db->bind("jadwal", $data["sesi"]);
        $this->db->bind("keterangan", $data["keterangan"]);
        $this->db->bind("harga", $data["harga"]);
        $this->db->bind("status", $data["status"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_member($data)
    {
        $sql = "UPDATE member SET nama_paket = :nama_paket, hari = :hari, jadwal = :jadwal, keterangan = :keterangan, harga = :harga, status_member = :status WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("nama_paket", $data["nama_paket"]);
        $this->db->bind("hari", $data["hari"]);
        $this->db->bind("jadwal", $data["sesi"]);
        $this->db->bind("keterangan", $data["keterangan"]);
        $this->db->bind("harga", $data["harga"]);
        $this->db->bind("status", $data["status"]);
        $this->db->bind("id", $data["id"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function is_package_member_used()
    {
        $sql = "SELECT * FROM member INNER JOIN transaksi_member ON member.id = transaksi_member.paket_member";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function delete_member($id)
    {
        $sql = "DELETE FROM member WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->row_count();
    }
}
