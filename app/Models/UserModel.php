<?php
namespace App\Controllers;
namespace App\Models;
use App\Models\UserModel;   // ⬅ WAJIB ada
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'password', 'no_hp', 'role'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // Tidak terpakai karena useSoftDeletes = false

    // Validation
    protected $validationRules = [
        'nama'  => 'required|min_length[3]',
        'no_hp' => 'required|regex_match[/^[0-9+]+$/]', // boleh tanda +
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'permit_empty|min_length[6]',   // kosong utk login Google
        'role' => 'permit_empty|in_list[customer,pegawai,pemilik]',
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama wajib diisi.',
            'min_length' => 'Nama minimal terdiri dari 3 karakter.',
        ],
        'no_hp' => [
            'required'    => 'Nomor HP wajib diisi.',
            'regex_match' => 'Nomor HP hanya berisi angka.',
        ],
        'email' => [
            'required'    => 'Email wajib diisi.',
            'valid_email' => 'Format email tidak valid.',
            'is_unique'   => 'Email sudah digunakan.',
        ],
        'password' => [
            'required'   => 'Password wajib diisi.',
            'min_length' => 'Password minimal terdiri dari 6 karakter.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Optional: Override method delete agar eksplisit
    public function delete($id = null, bool $purge = false)
    {
        if (!$this->find($id)) {
            log_message('warning', "User dengan ID $id tidak ditemukan saat ingin dihapus.");
            return false;
        }

        log_message('info', "User dengan ID $id dihapus.");
        return parent::delete($id, $purge);
    }

    // Callback untuk hash password
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password']) || empty($data['data']['password'])) {
            return $data;
        }

        // Jangan hash ulang jika sudah ter-hash
        if (!password_get_info($data['data']['password'])['algo']) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}