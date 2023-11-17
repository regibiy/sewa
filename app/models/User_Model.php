<?php

class User_Model
{
    private $table = "akun_pengguna";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_all_users()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->result_set();
    }

    public function get_user_by_username($username)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username=:username");
        $this->db->bind("username", $username);

        $this->db->execute();
        return $this->db->row_count();
    }

    public function get_data_user_by_username($username)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username=:username");
        $this->db->bind("username", $username);

        return $this->db->single();
    }

    public function add_user($data)
    {
        $sql = "INSERT INTO akun_pengguna (username, nama, password, email, jenis_kelamin, no_telp, status_member, status_akun) VALUES (:username, :nama, :password, :email, :jenis_kelamin, :no_telp, :status_member, :status_akun)";
        $this->db->query($sql);
        $this->db->bind("username", $data["username"]);
        $this->db->bind("nama", $data["nama"]);
        $this->db->bind("password", $data["password"]);
        $this->db->bind("email", $data["email"]);
        $this->db->bind("jenis_kelamin", $data["jenis_kelamin"]);
        $this->db->bind("no_telp", $data["no_telp"]);
        $this->db->bind("status_member", "Non-Member");
        $this->db->bind("status_akun", "Aktif");

        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_user($data)
    {
        $sql = "UPDATE akun_pengguna SET username = :username, nama = :nama, email = :email, jenis_kelamin = :jenis_kelamin, no_telp = :no_telp WHERE username = :username_old";

        $this->db->query($sql);
        $this->db->bind("username", $data["username"]);
        $this->db->bind("nama", $data["nama"]);
        $this->db->bind("email", $data["email"]);
        $this->db->bind("jenis_kelamin", $data["jenis_kelamin"]);
        $this->db->bind("no_telp", $data["no_telp"]);
        $this->db->bind("username_old", $_SESSION["user"]);

        $this->db->execute();
        return $this->db->row_count();
    }

    public function edit_password($data)
    {
        $sql = "UPDATE akun_pengguna SET password = :password WHERE username = :username";

        $this->db->query($sql);
        $this->db->bind("password", $data["new_password"]);
        $this->db->bind("username", $_SESSION["user"]);

        $this->db->execute();
        return $this->db->row_count();
    }

    public function update_status_member($data)
    {
        $sql = "UPDATE akun_pengguna SET status_member = :status_member WHERE id = :id_user";
        $this->db->query($sql);
        $this->db->bind("status_member", "Member");
        $this->db->bind("id_user", $data["id_user"]);

        $this->db->execute();
        return $this->db->row_count();
    }

    public function update_status_member_dua($id)
    {
        $sql = "UPDATE akun_pengguna SET status_member = :status_member WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind("status_member", "Non-Member");
        $this->db->bind("id", $id);

        $this->db->execute();
        return $this->db->row_count();
    }
}
