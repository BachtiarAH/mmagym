<?php

namespace LearnPhpMvc\Service;

use Exception;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive as ServiceDrive;
use Google\Service\Drive\Drive as DriveDrive;
use Google\Service\Drive\DriveFile;
use LearnPhpMvc\config\GoogleClient;

class Service
{

    protected ServiceDrive $driveService;

    public function FailResponse(string $type): array
    {
        $respons = array();

        if ($type == "format") {
            $respons['status'] = "fail";
            $respons['message'] = "format json salah";
        }

        return $respons;
    }

    public function googleDriveUpload(array $postRequest,String $formKey, $parent = '')
    {
        try {
            $driveService = new ServiceDrive(GoogleClient::getServiceClient());
            $fileMetadata = new DriveFile(array(
                'name' => $postRequest[$formKey]['name'],
                'parents' => [$parent]
            ));
            $content = file_get_contents($postRequest[$formKey]['tmp_name']);
            $file = $driveService->files->create($fileMetadata, array(
                'data' => $content,
                'mimeType' => $postRequest[$formKey]['type'],
                'uploadType' => 'multipart',
                'fields' => 'id'
            ));
            return $file->id;
        } catch (Exception $e) {
            echo "Error Message: " . $e;
        }
    }

    public function googleDriveDelete(String $fileId)
    {
        try {
            $this->driveService = new ServiceDrive(GoogleClient::getServiceClient());
            $this->driveService->files->delete($fileId);
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }
    }

    public function googleDriveReplaceFile(String $fileId,$formKey,$postRequest = array(),String $parent)
    {
        try {
            $this->googleDriveUpload($postRequest,$formKey,$parent);
            $this->googleDriveDelete($fileId);
            return "success";
        } catch (Exception $th) {
            return "somthing wrong ". $th->getMessage();
        }
    }
}
