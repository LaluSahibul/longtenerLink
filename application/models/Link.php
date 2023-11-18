<?php
class Link extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function tampil()
    {
        $this->db->order_by('tanggal', 'desc'); // Mengurutkan berdasarkan kolom 'tanggal' secara descending (terbaru dulu)
        $query = $this->db->get('link', 1); // Mengambil satu baris data teratas

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->link_panjang;
        } else {
            return null; // Atau sesuaikan dengan nilai default jika tidak ada data
        }
    }

    function simpan_data($data)
    {
        $this->db->insert('link', $data);
    }
    public function get_url($link_panjang)
    {
        $data = $this->db->where('link_panjang', $link_panjang)
            ->get('link');
        return $data->row()->link_asli;
    }

    // function getLinkAsliByLinkPanjang($link_panjang)
    // {
    //     $this->db->where('link_panjang', $link_panjang);
    //     $query = $this->db->get('link');

    //     if ($query->num_rows() > 0) {
    //         $row = $query->row();
    //         return $row->link_asli;
    //     } else {
    //         return null; // Atau sesuaikan dengan nilai default jika tidak ada data
    //     }
    // }
    // public function getOriginalLink($linkPanjang)
    // {
    //     // Ambil link asli dari database berdasarkan shortlink
    //     // Implementasikan sesuai dengan struktur dan skema database Anda
    //     $this->db->where('link_panjang', $linkPanjang);
    //     $query = $this->db->get('link');

    //     if ($query->num_rows() > 0) {
    //         return $query->row()->link_asli;
    //     } else {
    //         return false;
    //     }
    // }
}
