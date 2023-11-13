<?php
class Admin_Model
{
    private $table = "akun_pegawai";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_admins()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_admin_by_username($username)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username=:username");
        $this->db->bind("username", $username);

        $this->db->execute();
        return $this->db->row_count();
    }

    public function get_data_admin_by_username($username)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username=:username");
        $this->db->bind("username", $username);

        return $this->db->single();
    }
}
