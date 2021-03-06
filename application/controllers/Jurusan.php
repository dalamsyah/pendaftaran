<?php


class Jurusan extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->library('pdftc');
		$this->load->model('MJurusan');
		$this->load->model('MFormPendaftaran');
		$this->load->helper('url');
		$this->load->library('session');
	}

	function report(){
		$data['data'] = $this->MJurusan->getAll()->result();
		$this->load->view('jurusan_report', $data);
	}

	function index(){

		$data['data'] = $this->MJurusan->getAll()->result();
		$data['noPendaftaran'] = $this->MFormPendaftaran->getDistinctNoPendaftaran()->result();

		// var_dump($data); exit;

		$this->load->view('header');
		$this->load->view('jurusan_home', $data);
		$this->load->view('footer');
	}

	function save(){
		$data = array(
			'KODE_PROGRAM_KEAHLIAN' => $this->input->post('kodeProgramKeahlian'),
			'PROGRAM_KEAHLIAN' => $this->input->post('programKeahlian')
		);

		// var_dump($data); exit;

		if($this->input->post('modeEdit') != ""){
			$this->MJurusan->replace("jurusan", $data);
		}else{
			$this->MJurusan->save("jurusan", $data);
		}

		redirect('jurusan');
	}

	function delete(){
		$this->MJurusan->delete("jurusan", "KODE_PROGRAM_KEAHLIAN", $this->input->get('kodeProgramKeahlian') );
		redirect('jurusan');
	}

}