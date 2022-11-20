<?php

namespace LearnPhpMvc\config;

use Google\Client;

class GoogleClient
{

    static function getGoogleClientId()
    {
        return "23595683733-r76hqd7j8fjg97t42eou6nqr2m6re7ln.apps.googleusercontent.com";
    }

    static function getGoogleCLientSecret()
    {
        return "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";
    }

    static function getGoogleAuthScope()
    {
        return "https://www.googleapis.com/auth/drive";
    }

    static function getRedirectUri(int $indexUri)
    {
        $uris = [
            "http://localhost/mmagym/src/public/api/alat/add",
            "http://localhost/mmagym/src/public/"
        ];

        return $uris[$indexUri];
    }

    static function getServiceClient()
    {
        $client = new Client();
        putenv('GOOGLE_APPLICATION_CREDENTIALS=./credential.json');
        $client->useApplicationDefaultCredentials();
        $client->addScope(GoogleClient::getGoogleAuthScope());
        return $client;
    }
}
