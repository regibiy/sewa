<?php
class Informasi_Model
{
    private $table = "informasi";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_informations()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_inform_by_id($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind("id", $id);
        return $this->db->single();
    }

    public function add_inform($data)
    {
        $sql = "INSERT INTO informasi (judul, isi) VALUES (:judul, :isi)";
        $this->db->query($sql);
        $this->db->bind("judul", $data["judul"]);
        $this->db->bind("isi", nl2br($data["isi"]));
        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_inform($data)
    {
        $sql = "UPDATE informasi SET judul = :judul, isi = :isi WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $data["id"]);
        $this->db->bind("judul", $data["judul"]);
        $this->db->bind("isi", nl2br($data["isi"]));
        $this->db->execute();
        return $this->db->row_count();
    }

    public function delete_inform($id)
    {
        $sql = "DELETE FROM informasi WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->row_count();
    }
}
