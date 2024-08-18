<?php
class Projects extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('RestClient');
        $this->load->helper('url'); 
    }

    public function index() {
        $data['projects'] = $this->restclient->get('/proyek');
        $data['lokasi'] = $this->restclient->get('/Lokasi');
        $this->load->view('projects/index', $data);
    }
    public function form() {
        $this->load->view('projects/form');
    }

    public function view($id) {
        $data['project'] = $this->restclient->get("/proyek/{$id}");
        $this->load->view('projects/view', $data);
    }

    public function create() {
        // Read JSON input
    $input = file_get_contents('php://input');
    $postData = json_decode($input, true);
    
        // Ensure 'lokasi' is sent as an array
        if (isset($postData['proyek']) && !is_array($postData['proyek'])) {
            $postData['proyek'] = [$postData['proyek']];
        }
    
        // Send data to REST API
        $response = $this->restclient->post('/proyek', $postData);
    
        // Handle the response
        if ($response['status'] === 201) {
            // Redirect or load a success view
            redirect('projects');
        } else {
            // Handle error
            echo "Error: " . $response['message'];
        }
    }
    
    public function delete(){

    }
}
