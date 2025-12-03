<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Sage300Service
{
    protected $baseUrl;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->baseUrl = config('sage300.base_url');
        $this->username = config('sage300.username');
        $this->password = config('sage300.password');
    }

    /**
     * Make API request to Sage 300
     */
    private function makeRequest(string $endpoint, string $method = 'GET', array $data = [])
    {
        $http = Http::withBasicAuth($this->username, $this->password)
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->withoutVerifying();

        $url = $this->baseUrl . $endpoint;



        return match ($method) {
            'GET' => $http->get($url, $data),
            'POST' => $http->post($url, $data),
            'PUT' => $http->put($url, $data),
            'DELETE' => $http->delete($url),
            default => $http->get($url),
        };
    }

    /**
     * Get IC Shipments
     */
    public function getICShipments(array $params = [])
    {
        return $this->makeRequest('/IC/ICShipments', 'GET', $params);
    }

    /**
     * Get single shipment by ID
     */
    public function getShipmentById(string $shipmentNumber)
    {

        return $this->makeRequest("/IC/ICShipments({$shipmentNumber})");
    }

    /**
     * Get shipments with OData filter
     */
}
