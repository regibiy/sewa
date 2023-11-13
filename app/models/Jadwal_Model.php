<?php
class Jadwal_Model
{
    private $table = "jadwal";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_jadwal()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_jadwal_by_id($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function add_jadwal($data)
    {
        $sql = "INSERT INTO jadwal (sesi, hari, harga) VALUES (:sesi, :hari, :harga)";
        $this->db->query($sql);
        $this->db->bind("sesi", $data["sesi"]);
        $this->db->bind("hari", $data["hari"]);
        $this->db->bind("harga", $data["harga"]);

        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_jadwal($data)
    {
        $sql = "UPDATE jadwal SET sesi = :sesi, hari = :hari, harga = :harga WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("sesi", $data["sesi"]);
        $this->db->bind("hari", $data["hari"]);
        $this->db->bind("harga", $data["harga"]);
        $this->db->bind("id", $data["id"]);

        $this->db->execute();
        return $this->db->row_count();
    }
}
