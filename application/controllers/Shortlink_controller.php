<?php
class Shortlink_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Link'); // Memuat model Link
    }

    public function getOriginalLink($shortlink)
    {
        // Validasi shortlink
        if (!preg_match('/^[a-zA-Z0-9]+$/', $shortlink)) {
            // Shortlink tidak valid, mungkin tindakan yang sesuai seperti menampilkan 404
            show_404();
            return;
        }

        // Ambil link asli dari database berdasarkan shortlink
        $originalLink = $this->Link->getOriginalLink($shortlink);

        // Mengembalikan link asli dalam bentuk JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['originalLink' => $originalLink]));
    }
}
