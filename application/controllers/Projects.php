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
        $data['lokasi'] = $this->restclient->get('/Lokasi');
        $this->load->view('projects/form',$data);
    }

    public function view($id) {
        $data['project'] = $this->restclient->get("/proyek/{$id}");
        $this->load->view('projects/view', $data);
    }

    public function submit_form() {
        $this->load->library('RestClient');
    
    // Retrieve form data
    $nama_proyek = $this->input->post('nama_proyek');
    $client = $this->input->post('client');
    $tgl_mulai = date('d-m-Y', strtotime($this->input->post('tgl_mulai')));
    $tgl_selesai = date('d-m-Y', strtotime($this->input->post('tgl_selesai')));
    $pimpinan_proyek = $this->input->post('pimpinan_proyek');
    $keterangan = $this->input->post('keterangan');
    
    // Retrieve and process lokasi_id as an array
    $lokasi_id = $this->input->post('lokasi_id'); // This will be an array if multiple options are selected

    // Collect form data
    $form_data = array(
        'nama_proyek' => $nama_proyek,
        'client' => $client,
        'tgl_mulai' => $tgl_mulai,
        'tgl_selesai' => $tgl_selesai,
        'pimpinan_proyek' => $pimpinan_proyek,
        'keterangan' => $keterangan,
        'lokasi_id' => $lokasi_id // This will be an array
    );
        
        $endpoint = '/proyek'; // Endpoint relative to the base URL
    
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
                    redirect('index.php/projects/index');
                } else {
                    // Error
                    $data['error'] = 'Error: ' . $response['status_code'];
                    redirect('index.php/projects/index');
                    // $this->load->view('error_view', $data);
                }
            } else {
                $data['error'] = 'Unknown response format';
                $this->load->view('error_view', $data);
            }
        } catch (Exception $e) {
            $data['error'] = 'Exception: ' . $e->getMessage();
            $this->load->view('error_view', $data);
            redirect('index.php/projects/index');
        }
    }
    
    public function delete($id){
        $this->restclient->delete("/proyek/{$id}");
        redirect('index.php/projects/index');
    }
}
