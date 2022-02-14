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
            );

            if($request->getStatusCode() == 200){
                return json_decode($request->getBody(), true);
            }
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }

}