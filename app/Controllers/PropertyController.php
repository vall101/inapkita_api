<?php

namespace App\Controllers;

use App\Models\PropertyModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PropertyController extends ResourceController
{
    protected $modelName = PropertyModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound("Property not found");
    }

    public function create()
    {
        $data = $this->request->getPost();

        if (!$data || !is_array($data)) {
            return $this->failValidationErrors([
                'message' => 'Data tidak boleh kosong.',
                'required_fields' => [
                    'description', 'nama_kamar', 'harga', 'status', 'alamat', 'user_id', 'foto'
                ]
            ]);
        }

        // Ambil file foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();

            // Simpan ke writable/uploads
            $foto->move(WRITEPATH . 'uploads', $newName);

            // Salin ke public/uploads agar bisa diakses dari Flutter/browser
            if (!is_dir(FCPATH . 'uploads')) {
                mkdir(FCPATH . 'uploads', 0777, true); // Buat folder jika belum ada
            }
            copy(WRITEPATH . 'uploads/' . $newName, FCPATH . 'uploads/' . $newName);

            // Simpan URL lengkap di DB
$data['foto'] = $newName; // jangan pakai base_url()

        } else {
            return $this->failValidationErrors(['foto' => 'Gambar tidak valid']);
        }

        // Simpan ke DB
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        return $this->respond($data);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound("Property not found");
        }
        $this->model->delete($id);
        return $this->respondDeleted(['message' => "Property deleted"]);
    }
}
