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
    public function submit_form() {
        $this->load->library('RestClient');
        $angka = $this->input->post('lokasi_id');
        $output = array();

        foreach (explode(',', $angka) as $nums) {
            if (strpos($nums, '-') !== false) {
                list($from, $to) = explode('-', $nums);
                $output = array_merge($output, range($from, $to));
            } else {
                $output[] = $nums;
            }
        }
        // Collect form data
        $form_data = array(
            'nama_proyek' => $this->input->post('nama_proyek'),
            'client' => $this->input->post('client'),
            'tgl_mulai' => date('d-m-Y', strtotime($this->input->post('tgl_mulai'))),
            'tgl_selesai' => date('d-m-Y', strtotime($this->input->post('tgl_selesai'))),
            'pimpinan_proyek' => $this->input->post('pimpinan_proyek'),
            'keterangan' => $this->input->post('keterangan'),
            'lokasi_id' => $output
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
            redirect('index.php/projects/index');
        }
    }
    public function delete($id){
        $this->restclient->delete("/proyek/{$id}");
        redirect('index.php/projects/index');
    }
}
