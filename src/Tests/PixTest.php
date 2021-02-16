<?php

namespace Tests\Unit;

use BeeDelivery\AtarB2B\Pix;
use Illuminate\Validation\ValidationException;
use Orchestra\Testbench\TestCase;

class PixTest extends TestCase
{
    private $pix;

    public function setUp(): void
    {
        parent::setUp();

        $this->pix = new Pix();
    }

    public function test_key_is_required()
    {
        $this->expectException(\Exception::class);

        $key = '';

        $this->pix->validateKeyType($key);
    }
    
    public function test_key_could_not_be_identified()
    {
        $this->expectException(\Exception::class);

        $key = '112233';
        
        $this->pix->validateKeyType($key);
    }

    public function test_amount_is_integer()
    {   
        $this->expectException(\Exception::class);

        $data = [
            'amount' => '100',
            'description' => 'PHPUnit Test',
            'to' => [
                'key' => '55787940091',
                'type' => 'cpf',
                'institution' => '123456789',
                'institutionName' => 'Test Bank',
                'branch' => '0001',
                'accountNumber' => '123456',
                'accountType' => 'exampleType',
                'name' => 'John Doe',
                'document' => '55787940091',
            ],
        ];

        $this->pix->validatePixData($data);
    }

    public function test_all_data_are_required()
    {   
        $this->expectException(\Exception::class);

        $data = [
            'amount' => '',
            'description' => '',
            'to' => [
                'key' => '',
                'type' => '',
                'institution' => '',
                'institutionName' => '',
                'branch' => '',
                'accountNumber' => '',
                'accountType' => '',
                'name' => '',
                'document' => '',
            ],
        ];

        $this->pix->validatePixData($data);
    }
}
