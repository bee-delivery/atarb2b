<?php

namespace BeeDelivery\AtarB2B\Models;

use BeeDelivery\AtarB2B\Utils\Connection;

class Entity
{
    public $http;
    protected $entity;

    public function __construct()
    {
        $this->http = new Connection();
    }

    /**
     * Create an entity for the customer and return a Person with your newly created atarId.
     *
     * @see https://baas-dot-wearatar-dev.appspot.com/docs/origination
     * @param Array $entity
     * @return Array
     */
    public function create($entity)
    {
        $entity = $this->setEntity($entity);

        return $this->http->post('/entities', ['form_params' => $entity]);
    }

    /**
     * Retrieves a customer full entity.
     *
     * @see https://baas-dot-wearatar-dev.appspot.com/docs/origination
     * @param String $atarId
     * @return Array
     */
    public function getFullEntity($atarId)
    {
        return $this->http->get('/entities/' . $atarId);
    }

    /**
     * Merge the entity's information.
     *
     * @param Array $entity
     * @return Array
     */
    public function setEntity($entity)
    {
        try {

            if ( ! $this->entity_is_valid($entity) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->entity = array(
                "atarId" => '',
                "name" => '',
                "document" => '',
                "documentType" => '',
                "email" => '',
                "addresses" => [
                    {
                        "street" => '',
                        "streetNumber" => '',
                        "complement" => '',
                        "neighborhood" => '',
                        "city" => '',
                        "state" => '',
                        "country" => '',
                        "zipcode" => ''
                    }
                ],
                "birthDate" => '',
                "mothersName" => '',
                "phone" => '',
                "gender" => '',
                "citizenship" => '',
                "ppe" => '',
                "fiscalCountry" => '',
                "cboId" => '',
                "rgNumber" => '',
                "monthlyIncome" => '',
                "patrimony" => '',
                "creationDate" => ''
            );

            $this->entity = array_merge($this->entity, $entity);
            return $this->entity;
        } catch (\Exception $e) {
            return 'Erro ao definir o entity. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $entity
     * @return Boolean
     */
    public function entity_is_valid($entity)
    {
        return ! (
            empty($entity['atarId']) OR
            empty($entity['name']) OR
            empty($entity['document']) OR
            empty($entity['document_type']) OR
            empty($entity['email']) OR
            empty($entity['addresses']['street']) OR
            empty($entity['addresses']['streetNumber']) OR
            empty($entity['addresses']['complement']) OR
            empty($entity['addresses']['neighborhood']) OR
            empty($entity['addresses']['city']) OR
            empty($entity['addresses']['state']) OR
            empty($entity['addresses']['country']) OR
            empty($entity['addresses']['zipcode']) OR
            empty($entity['birthDate']) OR
            empty($entity['mothersName']) OR
            empty($entity['phone']) OR
            empty($entity['gender']) OR
            empty($entity['citizenship']) OR
            empty($entity['ppe']) OR
            empty($entity['fiscalCountry']) OR
            empty($entity['cboId']) OR
            empty($entity['rgNumber']) OR
            empty($entity['monthlyIncome']) OR
            empty($entity['patrimony']) OR
            empty($entity['creationDate'])
        );
    }
}
