<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\GerakanRepository;

class GerakanService extends Service
{
    protected GerakanRepository $repo;

    public function __construct(GerakanRepository $repo)
    {
        $this->repo = $repo;
    }

    public function addData($file, $data)
    {
        if (isset($data['nama']) && isset($file['video-gerakan']) && isset($file['foto-gerakan']) && isset($data['id_alat'])) {
            $nama = $data['nama'];
            $id_alat = $data['id_alat'];
            $idVideo = $this->googleDriveUpload($file, 'video-gerakan', '1KHsVlh1AwMGgpRdCi6W9wTzg52YhQVzW');
            $idfoto = $this->googleDriveUpload($file, 'foto-gerakan', '1JmaM2LER4bo1fQM3o226RS-yPI93NOuq');
            return $this->repo->addData($nama, $idVideo, $idfoto, $id_alat);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function findAll()
    {
        return $this->repo->findAll();
    }

    public function findById($data)
    {
        if (isset($data->id)) {
            return $this->repo->findById($data->id);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function findByName($data)
    {
        if (isset($data->nama)) {
            return $this->repo->findByName($data->nama);
        } else {
            return $this->FailResponse("format");
        }
    }

    public function findByAlat($data)
    {
        if (isset($data->id_alat)) {
            return $this->repo->findByAlat($data->id_alat);
        } else {
            return $this->FailResponse('format');
        }
    }

    public function editData($file, $post)
    {
        if (isset($post['nama']) && isset($file['foto-gerakan']) && isset($file['video-gerakan']) && isset($post['id_alat']) && isset($post['id'])) {
            $result = $this->repo->findById($post['id']);
            $gambar = $result['body'][0]['gambar'];
            $video = $result['body'][0]['video'];
            if (!empty($file['foto-gerakan']['name'])) {
                
            } else if (!empty($file['video-gerakan']['name'])) {
                $idVideo = $this->googleDriveReplaceFile($video, 'video-gerakan', $file, '1KHsVlh1AwMGgpRdCi6W9wTzg52YhQVzW');
                return $this->repo->editData($post['id'], $post['nama'], $idVideo, $gambar, $post['id_alat']);
            } else {
                echo 'gamabr';
                $idGambar = $this->googleDriveReplaceFile($gambar, 'foto-gerakan', $file, '1JmaM2LER4bo1fQM3o226RS-yPI93NOuq');
                echo 'video';
                $idVideo = $this->googleDriveReplaceFile($video, 'video-gerakan', $file, '1KHsVlh1AwMGgpRdCi6W9wTzg52YhQVzW');
                return $this->repo->editData($post['id'], $post['nama'], $idVideo, $idGambar, $post['id_alat']);
            }
            return ['message' => 'somethisng wrong'];
        } else {
            return $this->FailResponse('format');
        }
    }

    public function editDataNoFile($data)
    {
        if (isset($data->id) && isset($data->nama) && isset($data->id_alat)) {
            $result = $this->repo->findById($data->id);
            $gambar = $result['body'][0]['gambar'];
            $video = $result['body'][0]['video'];
            return $this->repo->editData($data->id, $data->nama, $video, $gambar, $data->id_alat);
        } else {
            return $this->FailResponse('format');
        }
    }

    public function editDataWithFoto($post,$file)
    {
        if (isset($post['id']) && isset($post['nama']) && isset($post['id_alat']) && isset($file['foto-gerakan'])) {
            $result = $this->repo->findById($post['id']);
            $gambar = $result['body'][0]['gambar'];
            $video = $result['body'][0]['video'];
            $idGambar = $this->googleDriveReplaceFile($gambar, 'foto-gerakan', $file, '1JmaM2LER4bo1fQM3o226RS-yPI93NOuq');
            return $this->repo->editData($post['id'], $post['nama'], $video, $idGambar, $post['id_alat']);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function editDataWithVideo($post,$file)
    {
        if (isset($post['id']) && isset($post['nama']) && isset($post['id_alat']) && isset($file['video-gerakan'])) {
            $result = $this->repo->findById($post['id']);
            $gambar = $result['body'][0]['gambar'];
            $video = $result['body'][0]['video'];
            $idVideo = $this->googleDriveReplaceFile($video, 'video-gerakan', $file, '1KHsVlh1AwMGgpRdCi6W9wTzg52YhQVzW');
            return $this->repo->editData($post['id'], $post['nama'], $idVideo, $gambar, $post['id_alat']);
        } else {
            return $this->FailResponse('format');
        }
        
    }

    public function deleteData($data)
    {
        if (isset($data->id)) {
            $result = $this->repo->findById($data->id);
            $gambar = $result['body'][0]['gambar'];
            $video = $result['body'][0]['video'];
            $this->googleDriveDelete($gambar);
            $this->googleDriveDelete($video);
            return $this->repo->deleteData($data->id);
        } else {
            return $this->FailResponse('format');
        }
    }
}
