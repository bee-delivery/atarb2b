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

    public function validateKey($key)
    {
        try {
            $this->validateKeyType($key);

            return $this->http->get('/pix/keys', $key);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function validatePixData($data)
    {
        $validator = Validator::make($data, [
            'amount' => 'required|integer',
            'description' => 'required|string',
            'to.key' => 'required|string',
            'to.type' => 'required|string',
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

    public function validateKeyType($key)
    {
        if (empty($key)) {
            $error = 'Pix key is required.';
            throw new \Exception($error);
        }

        switch ($key) {
            /* E-mail */
            case (filter_var($key, FILTER_VALIDATE_EMAIL)):
                break;

            /* CPF */
            case (is_numeric($key) && strlen($key) == 11):
                break;

            /* CNPJ */
            case (is_numeric($key) && strlen($key) == 14):
                break;

            /* Phone */
            case (is_numeric($key) && strlen($key) == 13):
                break;

            /* EVP */
            case (strlen($key) == 32):
                break;

            default:
                $error = 'Pix key could not be identified.';
                throw new \Exception($error);
        }
    }
}
