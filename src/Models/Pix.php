<?php

namespace BeeDelivery\AtarB2B\Models;

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
            $this->validatePixData($data);

            return $this->http->post('/pix/payment', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function validatePixData($data)
    {
        $validator = Validator::make($data, [
            'amount' => 'required|integer',
            'identifier' => 'string',
            'description' => 'string',
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

        // TODO: chamar método para verificar o tipo da chave pix

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            throw new \Exception($error);
        }

        if (! is_int($data['amount'])) {
            $error = 'The amount must be an integer.';
            throw new \Exception($error);
        }
    }
}
