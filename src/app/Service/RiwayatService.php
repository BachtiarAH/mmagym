<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\RiwayatRepository;

class RiwayatService extends Service
{
    protected RiwayatRepository $repo;

    public function __construct($repo)
    {
        $this->repo = $repo;
    }

    public function findRiwayatGerakanByUser($data)
    {
        if (isset($data->id_user)) {
            return $this->repo->findRiwayatGerakanByUser($data->id_user);
        } else {
            return $this->FailResponse('format');
        }
    }

    public function addData($data)
    {
        if (isset($data->id_user) && isset($data->id_gerakan)) {
            // mengubah zona waktu ke Jakarta
            date_default_timezone_set('Asia/Jakarta');

            // menampilkan tanggal sekarang dalam format YYYY-MM-DD
            $tanggal = date('Y-m-d');

            return $this->repo->addRiwayat($tanggal, $data->id_user, $data->id_gerakan);
        } else {
            return $this->FailResponse('format');
        }
    }
}
