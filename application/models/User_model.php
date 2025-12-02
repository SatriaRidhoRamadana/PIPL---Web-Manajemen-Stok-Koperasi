<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'user_account';
    protected $primaryKey = 'id_user';

    public function get_all()
    {
        return $this->db->order_by('full_name', 'ASC')->get($this->table)->result();
    }

    public function get($id)
    {
        return $this->db->where($this->primaryKey, $id)->get($this->table)->row();
    }

    public function get_by_username($username)
    {
        return $this->db->where('username', $username)->get($this->table)->row();
    }

    public function create($data)
    {
        $payload = array(
            'username' => $data['username'],
            'full_name' => $data['full_name'],
            'role' => $data['role'],
            // store password as plain text per request (username+123 migration)
            'password_hash' => $data['password'],
        );
        return $this->db->insert($this->table, $payload);
    }

    public function update($id, $data)
    {
        $payload = array(
            'username' => $data['username'],
            'full_name' => $data['full_name'],
            'role' => $data['role'],
        );

        if (!empty($data['password'])) {
            // store plain text password
            $payload['password_hash'] = $data['password'];
        }

        return $this->db->where($this->primaryKey, $id)->update($this->table, $payload);
    }

    public function delete($id)
    {
        return $this->db->where($this->primaryKey, $id)->delete($this->table);
    }

    public function validate_login($username, $password)
    {
        $user = $this->get_by_username($username);
        if ($user) {
            $stored = $user->password_hash;
            // Accept either bcrypt-verified or direct plain-text match
            if (!empty($stored) && (password_verify($password, $stored) || $stored === $password)) {
                return $user;
            }
        }
        return null;
    }
}

