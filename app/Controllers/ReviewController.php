<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use CodeIgniter\RESTful\ResourceController;

class ReviewController extends ResourceController
{
    protected $modelName = ReviewModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound('Review tidak ditemukan');
    }

    public function create()
    {
        // Deteksi apakah JSON atau Form
        $contentType = $this->request->getHeaderLine('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            try {
                $data = $this->request->getJSON(true);
            } catch (\Exception $e) {
                return $this->failValidationErrors(['json' => 'Format JSON tidak valid.']);
            }
        } else {
            $data = $this->request->getPost();
        }

        if (!$data || empty($data)) {
            return $this->failValidationErrors([
                'message' => 'Data tidak boleh kosong.',
                'required_fields' => [
                    'coment', 'rating', 'property_id', 'reservasi_id', 'user_id'
                ]
            ]);
        }

        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'message' => 'Review berhasil ditambahkan',
            'data'    => $data
        ]);
    }

    public function update($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID harus disediakan');
        }

        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->failNotFound('Review tidak ditemukan');
        }

        // Deteksi JSON atau Form
        $contentType = $this->request->getHeaderLine('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            try {
                $data = $this->request->getJSON(true);
            } catch (\Exception $e) {
                return $this->failValidationErrors(['json' => 'Format JSON tidak valid.']);
            }
        } else {
            $data = $this->request->getPost();
        }

        if (!$data || empty($data)) {
            return $this->failValidationErrors([
                'message' => 'Data tidak boleh kosong.',
                'required_fields' => [
                    'coment', 'rating', 'property_id', 'reservasi_id', 'user_id'
                ]
            ]);
        }

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Review berhasil diperbarui',
            'data'    => $data
        ]);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID harus disediakan');
        }

        $review = $this->model->find($id);
        if (!$review) {
            return $this->failNotFound('Review tidak ditemukan');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'message' => 'Review berhasil dihapus'
        ]);
    }
}
