<?php

namespace App\Services;

use Google\Cloud\Storage\StorageClient;

class FirebaseService
{
    /**
     * @var Firebase
     */
    public $firebase;
    
    public function __construct()
    {
        $storage = new StorageClient([
            "keyFile" => [
                "type" => "service_account",
                "project_id" => config('services.firebase.project_id'),
                "private_key_id" => config('services.firebase.private_key_id'),
                "private_key" => config('services.firebase.private_key'),
                "client_email" => config('services.firebase.client_email'),
                "client_id" => config('services.firebase.client_id'),
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => config('services.firebase.client_x509_cert_url')
            ],
        ]);

        $this->firebase = $storage->bucket(config('services.firebase.bucket'));
    }
}
