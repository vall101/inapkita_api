// app/Controllers/UploadController.php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class UploadController extends ResourceController
{
    public function show($filename = null)
    {
        $filePath = WRITEPATH . 'uploads/' . $filename;

        if (!file_exists($filePath)) {
            return $this->failNotFound('File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($filePath))
            ->setHeader('Content-Length', filesize($filePath))
            ->setBody(file_get_contents($filePath));
    }
}
