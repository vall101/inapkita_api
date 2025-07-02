<?php

namespace App\Controllers;

use App\Models\ReservasiModel;
use App\Models\ResepsionisModel;
use CodeIgniter\RESTful\ResourceController;

class RingkasanController extends ResourceController
{
    protected $reservasiModel;
    protected $resepsionisModel;

    public function __construct()
    {
        $this->reservasiModel   = new ReservasiModel();
        $this->resepsionisModel = new ResepsionisModel();
    }

    public function ringkasanHariIni()
    {
        $email = $this->request->getGet('email');

        if (!$email) {
            return $this->failValidationError('Email harus disertakan');
        }

        $resepsionis = $this->resepsionisModel->where('email', $email)->first();

        if (!$resepsionis) {
            return $this->failNotFound('Resepsionis tidak ditemukan');
        }

        // ✅ fix error entity jadi object
        $propertyId = $resepsionis->property_id;

        $checkinCount = $this->reservasiModel
            ->where('property_id', $propertyId)
            ->where('status', 'checkin')
            ->countAllResults();

        $checkoutCount = $this->reservasiModel
            ->where('property_id', $propertyId)
            ->where('status', 'checkout')
            ->countAllResults();

        $totalTamu = $this->reservasiModel
            ->where('property_id', $propertyId)
            ->countAllResults();

        return $this->respond([
            'checkin'     => $checkinCount,
            'checkout'    => $checkoutCount,
            'daftar_tamu' => $totalTamu
        ]);
    }
}
