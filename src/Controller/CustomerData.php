<?php

namespace src\classes;

require_once '../src/Helpers/RequestsHelper.php';

use Helpers\RequestsHelper;

class CustomerData
{

    public function __construct(
        protected RequestsHelper $requestsHelper = new RequestsHelper(),
        protected array $requestInfo = []
    ){
    }

    public function getCustomers()
    {
        try{
            $this->requestInfo = [
                'requestMethod' => 'GET',
                'requestUrl' => 'http://www.mocky.io/v2/5d9f39263000005d005246ae?mocky-delay=10s'
            ];

            $_SESSION['customersList'] = $this->requestsHelper->makeRequest($this->requestInfo);

            return $this->requestsHelper->makeRequest($this->requestInfo);
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function getOneCustomer($valueToSearch): array|string
    {
        try{
            $valueToSearch = $valueToSearch['searchCustomer'];
            return array_filter($_SESSION['customersList']['objects'], function ($value) use($valueToSearch){
                return ($value['first_name'] == $valueToSearch) ? $value : ($value['email'] == $valueToSearch ? $value : '');
            });
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function getAllCountries(): array|string
    {
        try{
            $this->requestInfo = [
                'requestMethod' => 'GET',
                'requestUrl' => 'https://countriesnow.space/api/v0.1/countries/capital'
            ];

            $allCountries = $this->requestsHelper->makeRequest($this->requestInfo);
            $_SESSION['countries'] = $allCountries['data'] ;

            return ($allCountries['data'] ?? []);
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }
}