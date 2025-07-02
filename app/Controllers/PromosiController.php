<?php

namespace App\Controllers;
use App\Models\PromosiModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PromosiController extends ResourceController
{
    protected $modelName = PromosiModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID harus disediakan');
        }

        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound('Promosi tidak ditemukan');
    }

    public function new()
    {
        //
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$data || empty($data)) {
            return $this->failValidationErrors([
                'message' => 'Data tidak boleh kosong.',
                'required_fields' => [
                    'diskon', 'harga_sebelum_diskon', 'harga_sesudah_diskon', 'ketentuan', 'property_id', 'user_id'
                ]
            ]);
        }

        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data);
    }

    public function edit($id = null)
    {
        //
    }

    public function update($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID harus disediakan');
        }

        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->failNotFound('Promosi tidak ditemukan');
        }

        $data = $this->request->getJSON(true);

        if (!$data || empty($data)) {
            return $this->failValidationErrors([
                'message' => 'Data tidak boleh kosong.',
                'required_fields' => [
                    'diskon', 'harga_sebelum_diskon', 'harga_sesudah_diskon', 'ketentuan', 'property_id', 'user_id'
                ]
            ]);
        }

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Promosi berhasil diperbarui',
            'data'    => $data
        ]);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID harus disediakan');
        }

        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Promosi tidak ditemukan');
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Promosi berhasil dihapus']);
    }
}