<?php

namespace BeeDelivery\AtarB2B;

use BeeDelivery\AtarB2B\Utils\Connection;
use Illuminate\Support\Facades\Validator;

class Pix
{
    public $http;

    public function __construct()
    {
        $this->http = new Connection();
    }

    public function transfer($data)
    {
        try {
            $data = $this->validatePixData($data);

            return $this->http->post('/pix/payment', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function validatePixData($data)
    {
        $data = $this->setKeyType($data);

        $validator = Validator::make($data, [
            'amount' => 'required|integer',
            'identifier' => 'required|string',
            'description' => 'required|string',
            'to.key' => 'required|string',
            'to.type' => 'required|string',
            'to.timestamp' => 'required|string',
            'to.isFavorite' => 'required|bool',
            'to.status' => 'required|string',
            'to.statusResolutionTimestamp' => 'required|string',
            'to.institution' => 'required|string',
            'to.institutionName' => 'required|string',
            'to.branch' => 'required|string',
            'to.accountNumber' => 'required|string',
            'to.accountType' => 'required|string',
            'to.name' => 'required|string',
            'to.document' => 'required|string'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            throw new \Exception($error);
        }


        if (! is_int($data['amount'])) {
            $error = 'The amount must be an integer.';
            throw new \Exception($error);
        }

        return $data;
    }
    
    public function setKeyType($data)
    {
        if (empty($data['to']['type'])) {
            $key = $data['to']['key'];

            switch ($key) {
                case (filter_var($key, FILTER_VALIDATE_EMAIL)):
                    $data['to']['type'] = 'email';
                    break;
                case (is_numeric($key) && strlen($key) == 11):
                    $data['to']['type'] = 'cpf';
                    break;
                case (is_numeric($key) && strlen($key) == 14):
                    $data['to']['type'] = 'cnpj';
                    break;
                case (is_numeric($key) && strlen($key) == 13):
                    $data['to']['type'] = 'phone';
                    break;
                case (strlen($key) == 32):
                    $data['to']['type'] = 'evp';
                    break;
                default:
                    $error = 'Pix key could not be identified.';
                    throw new \Exception($error);
            }
        }

        return $data;
    }
}
