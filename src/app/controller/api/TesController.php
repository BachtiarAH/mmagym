<?php

namespace LearnPhpMvc\controller\api;

use Exception;
use Google\Client;
use Google\Service\Drive as ServiceDrive;
use Google\Service\Drive\DriveFile;
use LearnPhpMvc\config\GoogleClient;
use LearnPhpMvc\Service\TesService;

class TesController
{
    protected ServiceDrive $gDrvieService;
    protected TesService $service;

    public function __construct() {
        $this->service = new TesService();
    }

    public function updateFile()
    {
        $response = $this->service->googleDriveUpload($_FILES,'1lPJlSqxBpdjDW3dYdr0PtRs-kPzt51K6');
        echo $response;
    }

    public function deleteGoogleDriveFile()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        $client = new Client();
        putenv('GOOGLE_APPLICATION_CREDENTIALS=./credential.json');
        $client->useApplicationDefaultCredentials();
        $client->addScope(GoogleClient::getGoogleAuthScope());
        $this->gDrvieService = new ServiceDrive($client);
        $this->service->googleDriveDelete($request->fileId);
    }

    public function replaceGoogleDrifeFile()
    {
        $this->service->googleDriveReplaceFile($_POST['fileId'],'foto-alat',$_FILES,'1lPJlSqxBpdjDW3dYdr0PtRs-kPzt51K6');
    }

    public function createGDriveFile()
    {
        $this->service->googleDriveUpload($_FILES,'foto-alat','1lPJlSqxBpdjDW3dYdr0PtRs-kPzt51K6');
    }
}
