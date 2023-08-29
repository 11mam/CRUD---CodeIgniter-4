<?php

namespace App\Controllers;

class Buku extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
        $this->bukuModel = new \App\Models\BukuModel();
    }

    public function index()
    {
        $databuku = $this->bukuModel->findAll();
        $data = ['databuku' => $databuku];

        return view('daftar_buku', $data);
    }

    public function addBuku()
    {
        session();
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('add_buku', $data);
    }

    public function save()
    {

        // FUNGSI VALIDASI
        if (!$this->validate([
            'judul' => 'required|is_unique[buku.judul]',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'uploaded' => 'Pilih Gambar',
                    'max_size' => 'Maksimum Ukuran 1MB',
                    'is_image' => 'Jenis gambar jpg, jpeg, png atau gif',
                    'mime_in'  => 'File Bukan Gambar'
                ],
            ]
        ])) {
            return redirect()->to('/buku/addbuku')->withInput();
        }

        // ambilfile
        $fileupload = $this->request->getFile('sampul');

        //Jika menggunakan nama asli
        // $filename = $fileupload->getName();
        $filename = $fileupload->getRandomName();

        //memindahkan file ke folder images di public
        $fileupload->move('images', $filename);


        $this->bukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'jumlah_halaman' => $this->request->getVar('jumlah_halaman'),
            'sampul' => $filename,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Disimpan');

        return redirect()->to('/buku');
    }

    public function edit()
    {
        $id = $this->request->getVar('id_edit');

        session();
        $data = [
            'validation' => \Config\Services::validation(),
            'item' => $this->bukuModel->getBuku($id)
        ];

        return view('edit_buku', $data);
    }

    public function proses_edit()
    {
        $id = $this->request->getVar('id_edit');

        $buku_current = $this->bukuModel->getBuku($id);
        //Cek jika judulnya sama dengan judul sebelumnya,
        //diperlukan karena is_uniq akan menganggap judul sudah
        //digunakan jika tidak dirubah
        if ($this->request->getVar('judul') == $buku_current['judul']) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }


        // FUNGSI VALIDASI
        if (!$this->validate([
            'judul' => $rule_judul,
            'pengarang' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'uploaded' => 'Pilih Gambar',
                    'max_size' => 'Maksimum Ukuran 1MB',
                    'is_image' => 'Jenis gambar jpg, jpeg, png atau gif',
                    'mime_in'  => 'File Bukan Gambar'
                ],
            ]
        ])) {
            return redirect()->to('/buku/proses_edit')->withInput();
        }

        // ambilfile
        $fileupload = $this->request->getFile('sampul');

        //Jika menggunakan nama asli
        // $filename = $fileupload->getName();
        $filename = $fileupload->getRandomName();

        //memindahkan file ke folder images di public
        $fileupload->move('images', $filename);

        // Hapus gambar sampul lama
        if (file_exists('images/' . $this->request->getVar('sampul_old'))) {
            unlink('images/' . $this->request->getVar('sampul_old'));
        }

        $this->bukuModel->save(
            [
                'id' => $id,
                'judul' => $this->request->getVar('judul'),
                'pengarang' => $this->request->getVar('pengarang'),
                'penerbit' => $this->request->getVar('penerbit'),
                'jumlah_halaman' => $this->request->getVar('jumlah_halaman'),
                'sampul' => $filename
            ]
        );

        session()->setFlashdata('pesan', 'Data Berhasil Diedit');

        return redirect()->to('/buku');
    }

    public function delete()
    {
        $id = $this->request->getVar('id_delete');
        $buku_current = $this->bukuModel->getBuku($id);
    

        if (file_exists('images/' . $buku_current['sampul'])) {
            unlink('images/' . $buku_current['sampul']);
        }

        $this->bukuModel->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/buku');
    }
}
