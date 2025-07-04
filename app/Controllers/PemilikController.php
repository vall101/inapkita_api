<?php

namespace App\Controllers;
use App\Models\PemilikModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PemilikController extends ResourceController
{
    protected $modelName = \App\Models\PemilikModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound('Data pemilik tidak ditemukan');
    }

    public function new()
    {
        //
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
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
        $data = $this->request->getJSON(true);
        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        return $this->respond($data);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data pemilik tidak ditemukan');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Data pemilik berhasil dihapus']);
    }
}
