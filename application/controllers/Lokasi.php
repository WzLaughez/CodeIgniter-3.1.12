<?php
class Lokasi extends CI_Controller {
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
        $this->load->view('lokasi/form');
    }

    public function view($id) {
        $data['project'] = $this->restclient->get("/proyek/{$id}");
        $this->load->view('projects/view', $data);
    }

    public function submit_form() {
        $this->load->library('RestClient');
        
        // Collect form data
        $form_data = array(
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'negara' => $this->input->post('negara'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
        );
        
        $endpoint = '/Lokasi'; // Endpoint relative to the base URL
    
        try {
            // Send POST request with JSON payload
            $response = $this->restclient->post($endpoint, $form_data);
    
            // Handle response
            if (isset($response['status_code'])) {
                if ($response['status_code'] == 200) {
                    // Success
                    $data['result'] = $response['body'];
                    // $this->load->view('success_view', $data);
                    redirect('index.php/projects/index');
                } elseif ($response['status_code'] == 303) {
                    // Handle redirect
                    // Redirect to the new URL specified by the 'Location' header
                    $redirect_url = isset($response['headers']['Location']) ? $response['headers']['Location'] : 'index.php/projects/index';
                    redirect($redirect_url);
                } else {
                    // Error
                    $data['error'] = 'Error: ' . $response['status_code'];
                    $this->load->view('error_view', $data);
                }
            } else {
                $data['error'] = 'Unknown response format';
                $this->load->view('error_view', $data);
            }
        } catch (Exception $e) {
            $data['error'] = 'Exception: ' . $e->getMessage();
            $this->load->view('error_view', $data);
        }
    }
    
    
    
    public function delete(){

    }
}
