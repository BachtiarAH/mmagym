<?php
use Google\Client;
use Google\Service\Drive;
# TODO - PHP client currently chokes on fetching start page token
function uploadBasic()
{
    try {
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope(Drive::DRIVE);
        $driveService = new Drive($client);
        $fileMetadata = new Drive\DriveFile(array(
        'name' => 'photo.jpg'));
        $content = file_get_contents('../files/photo.jpg');
        $file = $driveService->files->create($fileMetadata, array(
            'data' => $content,
            'mimeType' => 'image/jpeg',
            'uploadType' => 'multipart',
            'fields' => 'id'));
        printf("File ID: %s\n", $file->id);
        return $file->id;
    } catch(Exception $e) {
        echo "Error Message: ".$e;
    } 

}