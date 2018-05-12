<?php
class User_model extends CI_Model
{

    public $id;
    public $email;
    public $persona_id;

    public function login_user()
    {   
        $this->db->select('id, email, persona_id');
        $this->db->from('users');
        $this->db->where(array('email' => $_POST['email'], 'password' => md5($_POST['password'])));
        $query = $this->db->get();
        $user = $query->row();
        return isset($user) ? $user : false;
    }

    /*public function insert_user()
    {
        $this->email   = $_POST['email']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('users', $this);
    }

    public function update_user()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('users', $this, array('id' => $_POST['id']));
    }*/

}
