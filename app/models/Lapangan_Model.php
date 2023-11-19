<?php
class Lapangan_Model
{
    private $table = "lapangan";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_lapangan()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_lapangan_by_id($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function add_lapangan($data)
    {
        $sql = "INSERT INTO lapangan (nama_lapangan, status_lapangan, status_booking) VALUES (:nama_lapangan, :status_lapangan, :status_booking)";
        $this->db->query($sql);
        $this->db->bind("nama_lapangan", $data["nama_lapangan"]);
        $this->db->bind("status_lapangan", $data["status_lapangan"]);
        $this->db->bind("status_booking", null);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_lapangan($data)
    {
        $sql = "UPDATE lapangan SET nama_lapangan = :nama_lapangan, status_lapangan = :status_lapangan WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("nama_lapangan", $data["nama_lapangan"]);
        $this->db->bind("status_lapangan", $data["status_lapangan"]);
        $this->db->bind("id", $data["id"]);
        $this->db->execute();
        return $this->db->row_count();
    }
}
