<?php
class Rekening_Model
{
    private $table = "metode_pembayaran";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_payment_methods()
    {
        //some get all methods has status field that must be a criteria when get all data !!!WARNING
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_payment_method_by_id($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function add_payment_method($data)
    {
        $sql = "INSERT INTO metode_pembayaran (nama_bank, nama_pemilik, no_rekening, status) VALUES (:nama_bank, :nama_pemilik, :no_rekening, :status)";
        $this->db->query($sql);
        $this->db->bind("nama_bank", $data["nama_bank"]);
        $this->db->bind("nama_pemilik", $data["nama_pemilik"]);
        $this->db->bind("no_rekening", $data["no_rekening"]);
        $this->db->bind("status", $data["status"]);

        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_payment_method($data)
    {
        $sql = "UPDATE metode_pembayaran SET nama_bank = :nama_bank, nama_pemilik = :nama_pemilik, no_rekening = :no_rekening, status = :status WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("nama_bank", $data["nama_bank"]);
        $this->db->bind("nama_pemilik", $data["nama_pemilik"]);
        $this->db->bind("no_rekening", $data["no_rekening"]);
        $this->db->bind("status", $data["status"]);
        $this->db->bind("id", $data["id"]);

        $this->db->execute();
        return $this->db->row_count();
    }
}
