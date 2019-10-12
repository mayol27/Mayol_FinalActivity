<?php
class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->view("main_view", $data);
    }

    public function index()
    {
        $this->load->model("main_model");
        $data["fetch_data"] = $this->main_model->fetch_data();
        $this->load->view("main_view", $data);
    }

    public function form_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules("fname", "First Name", 'required');
        $this->form_validation->set_rules("lname", "Last Name", 'required');
        $this->form_validation->set_rules("uname", "User Name", 'required');
        $this->form_validation->set_rules("password", "Password", 'required');
        // $this->form_validation->set_rules("cpassword", "Confirm Password", 'required');

        if( $this->form_validation->run())
        {
            $this->load->model("main_model");
            $data = array(
                "fname" =>$this->input->post("fname"),
                "lname" =>$this->input->post("lname"),
                "uname" =>$this->input->post("uname"),
                "password" =>$this->input->post("password")
            );

            $this->main_model->insert_data($data);

            redirect(base_url()."main/inserted");
        }
        else
        {
            $this->index();
        }
    }

    public function inserted()
    {
        $this->index();
    }

    public function delete_data()
    {
        $id = $this->uri->segment(3);
        $this->load->model("main_model");
        $this->main_model->delete_data($id);
        redirect(base_url()."main/deleted");
    }

    public function deleted()
    {
        $this->index();
    }

    public function update_data()
    {
        $user_id = $this->uri->segment(3);
        $this->load->model("main_model");
        $data["user_data"] = $this->main_model->fetch_single_data($user_id);
        $data["fetch_data"] = $this->main_model->fetch_data();
        $this->load->view("main_view", $data);
    }

    function login()
    {
        $data['title']='Login';
        $this->load->view("login", $data);
    }

    function login_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run())
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('main_model');

            if ($this->main_model->can_login($username, $password)) 
            {
                $session_data = array (
                    'username' => $username
                );
                $this->session->set_userdata($session_data);
                redirect(base_url().'main/enter');
            }
            else
            {
                $this->session->set_flashdata('error','Invalid username and password');
                redirect(base_url().'main/login');
            }
        }
        else
        {
            $this->login();
        }
    }

    function enter()
    {
        if($this->session->userdata('username') !="")
        {
            $this->index();
            echo '<h2>welcome -'.$this->session->userdata('username').'</h2>';
            echo '<a href="'.base_url().'main/logout">logout</a>';
        }
        else
        {
            redirect(base_url().'main/login');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('username');
        redirect(base_url().'main/login');
    }

    function image_upload()
    {
        $data['title'] = "upload image";
        $this->load->view('image_upload',$data);
    }
    
    function ajax_upload()
    {
        if(isset($_FILES["image_file"]["name"]))
        {
            $config['upload_path']='./upload';
            $config['allowed_types']='jpg|jpeg|png|gif';
            $this->load->library('upload',$config);

            if ($this->upload->do_upload('image_file')) 
            {
                echo $this->upload->display_errors();
            }
            else
            {
                $data = $this->upload->data();
                echo '<img src="'.base_url().'upload/'.$data["file_name"].'">';
            }
        }
    }

    public function file_upload()
    {
        $config['upload_path']='./upload';
        $config['allowed_types']='*';
        $this->load->library('upload',$config);
        $this->upload->do_upload('file_name');
        $file_name=$this->upload->data();
        $data=array('file_name'=>$file_name['file_name']);
        $this->main_model->File_upload($data);
    }
}
?>