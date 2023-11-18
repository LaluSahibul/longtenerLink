<?php
class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Link');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $chars = "abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ0123456789";
        $linkInput = '';
        $textLength = 6000;
        for ($i = 0; $i < $textLength; $i++) {
            $randomChar = $chars[rand(0, strlen($chars) - 1)];
            $linkInput .= $randomChar;
        }
        $link_asli = $this->input->post('links');
        $link_panjang = $linkInput;

        $this->form_validation->set_rules('links', 'URL', 'required|valid_url');

        // $tampil['link'] = $this->Link->tampil();
        $tampil['link'] = $link_panjang;
        if ($this->form_validation->run() != FALSE) {
            $data = array(
                'link_asli' => $link_asli,
                'link_panjang' => $link_panjang,
            );
            $this->Link->simpan_data($data);
            $this->load->view('viewHome', $tampil);
        } else {
            $this->load->view('viewHome');
        }
    }

    // public function panjang()
    // {
    //     $chars = "abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ0123456789";
    //     $linkInput = '';
    //     $textLength = 5000;
    //     for ($i = 0; $i < $textLength; $i++) {
    //         $randomChar = $chars[rand(0, strlen($chars) - 1)];
    //         $linkInput .= $randomChar;
    //     }
    //     $link_asli = $this->input->post('links');
    //     $link_panjang = $linkInput;

    //     $this->form_validation->set_rules('links', 'links', 'required');

    //     $tampil['link'] = $this->Link->tampil();
    //     if ($this->form_validation->run() != FALSE) {
    //         $data = array(
    //             'link_asli' => $link_asli,
    //             'link_panjang' => $link_panjang,
    //         );
    //         $this->Link->simpan_data($data);
    //         $this->load->view('viewHome', $tampil);
    //     } else {
    //         $this->load->view('viewHome');
    //     }
    // }
    // public function redirect($link_panjang)
    // {
    //     // Cari link asli berdasarkan link panjang di database
    //     $link_asli = $this->Link->getLinkAsliByLinkPanjang($link_panjang);

    //     if ($link_asli) {
    //         // Lakukan pengalihan ke link asli
    //         redirect($link_asli, 'location', 301);
    //     } else {
    //         // Tindakan yang sesuai jika link panjang tidak ditemukan
    //         show_404();
    //     }
    // }
    // public function r()
    // {
    //     $url = $this->uri->segment(3);
    //     echo ($url);
    // }
    public function redirectUrl($link_panjang = '')
    {
        $orignal_url = $this->Link->get_url($link_panjang);
        if ($orignal_url) {
            redirect($orignal_url);
        } else {
            echo ("gak ada link oy");
        }
    }
}
