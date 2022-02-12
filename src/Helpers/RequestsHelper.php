<?php

namespace Helpers;

require_once '../vendor/autoload.php';

use GuzzleHttp\Client;

class RequestsHelper
{

    public function __construct(protected Client $client = new Client())
    {
    }

    public function makeRequest(array $requestInfo){
        try{
            $request = $this->client->request(
                $requestInfo['requestMethod'],$requestInfo['requestUrl']
            )->getBody();
            return json_decode($request, true);
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }

}