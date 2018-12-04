<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pesanan');
    }

    public function index(){
        if(!$this->session->logged_in){
            redirect('/login');
        }else{
            $data['waitlist'] = $this->m_pesanan->get_wait_list('pesanan','statusPesanan','waitinglist');
            if(empty($data['waitlist'])){
                show_404();
            }
            $this->load->view('admin/admin_header');
            $this->load->view('admin/waitlist', $data);
            $this->load->view('template/footer');
        }
    }

    public function on_process(){
        if(!$this->session->logged_in){
            redirect('/login');
        }else{
            $data['onprocess'] = $this->m_pesanan->get_wait_list('pesanan','statusPesanan','onprocess');
            if(empty($data['onprocess'])){
                show_404();
            }
            $this->load->view('admin/admin_header');
            $this->load->view('admin/on_process', $data);
            $this->load->view('template/footer');
        }
    }

    public function finished(){
        if(!$this->session->logged_in){
            redirect('/login');
        }else{
            $data['finished'] = $this->m_pesanan->get_wait_list('pesanan','statusPesanan','finished');
            if(empty($data['finished'])){
                show_404();
            }
            $this->load->view('admin/admin_header');
            $this->load->view('admin/finished', $data);
            $this->load->view('template/footer');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('/login');
    }
}
