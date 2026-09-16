<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class KepegawaianService {
    private $apiUrl;
    private $apiAuth;

    function __construct($data = []) {
        $this->apiUrl  = config('services.service_simpeg_v2.url', 'https://kepegawaian.ummetro.ac.id/ws/');
        $this->apiAuth = config('services.service_simpeg_v2.secret', 'iJh80U45Qc5g4D3E16Iu8YmoMQkVflcFoHsWor18bf70db89');
    }

    public function get($route, $data = [])
    {
        $response   = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$this->apiAuth
        ])->get($this->apiUrl. $route, $data);
        return $response;
    }

    public function post($route, $data = [])
    {
        $response   = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$this->apiAuth
        ])->post($this->apiUrl. $route, $data);
        return $response;
    }
}
