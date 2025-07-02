<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ReservasiController extends ResourceController
{
    protected $modelName = ReservasiModel::class;
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
        return $data ? $this->respond($data) : $this->failNotFound('Reservasi tidak ditemukan');
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$data || empty($data)) {
            return $this->failValidationErrors([
                'message' => 'Data tidak boleh kosong.',
                'required_fields' => [
                    'status', 'check_in', 'check_out', 'total_harga', 'user_id', 'property_id'
                ]
            ]);
        }

        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID harus disediakan');
        }

        $existing = $this->model->find($id);
        if (!$existing) {
            return $this->failNotFound('Reservasi tidak ditemukan');
        }

        $data = $this->request->getJSON(true);

        if (!$data || empty($data)) {
            return $this->failValidationErrors([
                'message' => 'Data tidak boleh kosong.',
                'required_fields' => [
                    'status', 'check_in', 'check_out', 'total_harga', 'user_id', 'property_id'
                ]
            ]);
        }

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Reservasi berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return $this->failValidationError('ID harus disediakan');
        }

        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Reservasi tidak ditemukan');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'message' => 'Reservasi berhasil dihapus'
        ]);
    }

    /**
     * API ringkasan aktivitas harian untuk resepsionis
     * GET /ringkasan-hari-ini/{property_id}
     */
    public function ringkasanHariIni($propertyId)
    {
        $tanggalHariIni = date('Y-m-d');

        $checkin = $this->model
            ->where('property_id', $propertyId)
            ->where('check_in', $tanggalHariIni)
            ->countAllResults();

        $checkout = $this->model
            ->where('property_id', $propertyId)
            ->where('check_out', $tanggalHariIni)
            ->countAllResults();

        $daftarTamu = $this->model
            ->where('property_id', $propertyId)
            ->countAllResults();

        return $this->respond([
            'checkin'     => $checkin,
            'checkout'    => $checkout,
            'daftar_tamu' => $daftarTamu,
        ]);
    }
}
