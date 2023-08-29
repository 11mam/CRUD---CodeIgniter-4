<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul','pengarang','penerbit','jumlah_halaman','sampul']; 

    public function getBuku($id) 
    {
        return $this->where(["id" => $id])->first();     
    }

    public function editBuku($id,$data)
    {
        $this->where('id',$id);
        $this->update($data);
    }

}