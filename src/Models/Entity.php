<?php

namespace BeeDelivery\AtarB2B\Models;

class Entity
{

    const DOCUMENT_TYPE_CPF = 'cpf';
    const DOCUMENT_TYPE_CNPJ = 'cnpj';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDocumentTypeAllowableValues()
    {
        return [
            self::DOCUMENT_TYPE_CPF,
            self::DOCUMENT_TYPE_CNPJ,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['atar_id'] = isset($data['atar_id']) ? $data['atar_id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['document'] = isset($data['document']) ? $data['document'] : null;
        $this->container['document_type'] = isset($data['document_type']) ? $data['document_type'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getDocumentTypeAllowableValues();
        if (!is_null($this->container['document_type']) && !in_array($this->container['document_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'document_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }

}
