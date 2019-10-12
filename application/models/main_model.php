<?php
class Main_model extends CI_Model
{
    public function test_main()
    {
        echo 'weew';
    }

    function insert_data($data)
    {
        $this->db->insert("user",$data);
    }

    function fetch_data()
    {
        $query = $this->db->query("SELECT * FROM user ORDER BY id DESC");
        return $query;
    }

    function delete_data($id)
    {
        $this->db->where("id",$id);
        $this->db->delete("user");
    }

    function fetch_single_data($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get("user");
        return $query;
    }

    function can_login($username,$password)
    {
        $this->db->where('uname',$username);
        $this->db->where('password',$password);

        $query =$this->db->get('user');

        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function File_upload($data)
    {
        // $query = $this->db->insert('img',$data);
        $this->db->insert("img",$data);
        
        if($query)
        {
            echo "file upload Success";
        }
        else 
        {
            echo "file error";
        }
    }
}
?>