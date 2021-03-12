<?php

namespace BeeDelivery\AtarB2B\Utils;

use Illuminate\Support\Facades\Validator;

trait Helpers
{
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
            throw new \Exception($validator->errors()->first());
        }

        if (! is_int($data['amount'])) {
            throw new \Exception('The amount must be an integer.');
        }

        return $data;
    }

    public function validateKeyType($key)
    {
        if (empty($key)) {
            throw new \Exception('Pix key is required.');
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
            case (strlen($key) == 36):
                break;

            default:
                throw new \Exception('Pix key could not be identified.');
        }
    }
}
