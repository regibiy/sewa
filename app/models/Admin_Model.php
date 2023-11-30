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

    public function get_owner()
    {
        $sql = "SELECT * FROM akun_pegawai WHERE role = :role";
        $this->db->query($sql);
        $this->db->bind("role", "Owner");
        $this->db->execute();
        return $this->db->row_count();
    }

    public function get_data_admin_by_id($id)
    {
        $this->db->query("SELECT * FROM akun_pegawai WHERE id = :id");
        $this->db->bind("id", $id);
        return $this->db->single();
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

    public function add_pegawai($data)
    {
        $sql = "INSERT INTO akun_pegawai (username, nama, password, email, jenis_kelamin, no_telp, role, status_akun) VALUES (:username, :nama, :password, :email, :jenis_kelamin, :no_telp, :role, :status_akun)";
        $this->db->query($sql);
        $this->db->bind("username", $data["username"]);
        $this->db->bind("nama", $data["nama"]);
        $this->db->bind("password", $data["password_pegawai"]);
        $this->db->bind("email", $data["email"]);
        $this->db->bind("jenis_kelamin", $data["jenis_kelamin"]);
        $this->db->bind("no_telp", $data["no_telp"]);
        $this->db->bind("role", $data["role"]);
        $this->db->bind("status_akun", $data["status_akun"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_pegawai($data)
    {
        $sql = "UPDATE akun_pegawai SET username = :username, nama = :nama, password = :password, email = :email, jenis_kelamin = :jenis_kelamin, no_telp = :no_telp, role = :role, status_akun = :status_akun WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("username", $data["username"]);
        $this->db->bind("nama", $data["nama"]);
        $this->db->bind("password", $data["password_pegawai"]);
        $this->db->bind("email", $data["email"]);
        $this->db->bind("jenis_kelamin", $data["jenis_kelamin"]);
        $this->db->bind("no_telp", $data["no_telp"]);
        $this->db->bind("role", $data["role"]);
        $this->db->bind("status_akun", $data["status_akun"]);
        $this->db->bind("id", $data["id"]);
        $this->db->execute();
        return $this->db->row_count();
    }

    public function delete_admin($id)
    {
        $sql = "DELETE FROM akun_pegawai WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("id", $id);
        $this->db->execute();
        return $this->db->row_count();
    }
}
