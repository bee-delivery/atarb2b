<?php


namespace BeeDelivery\AtarB2B;


class Entitie
{
    public $http;
    protected $entitie;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Create an entity for the customer and return a Person with your newly created atarId.
     *
     * @see https://baas-dot-wearatar-dev.appspot.com/docs/origination
     * @param Array entitie
     * @return Array
     */
    public function criar($entitie)
    {
        $cliente = $this->setEntitie($entitie);
        return $this->http->post('/entities', ['form_params' => $cliente]);
    }

    /**
     * Atualiza o cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/PUT-api-v4-Cliente
     * @param Array cliente
     * @return Array
     */
    public function atualizar($cliente)
    {
        return $this->http->put('api/v4/Cliente', ['form_params' => $cliente]);
    }

    /**
     * Pesquisa um cliente PagueVeloz.
     *
     * @see
     * @param Array cliente
     * @return Array
     */
    public function pesquisar($termo)
    {
        return $this->http->get('api/v3/Transferencia/ClienteDestino?filtro=' . $termo );
    }

    /**
     * Lista os usuarios do cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/GET-api-v2-UsuarioCliente
     * @return Array
     */
    public function usuarios()
    {
        return $this->http->get('api/v2/UsuarioCliente');
    }

    /**
     * Lista os documentos pendentes do cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/GET-api-v4-Cliente-DocumentosPendentes_contaBancariaId
     * @return Array
     */
    public function documentosPendentes()
    {
        return $this->http->get('api/v4/Cliente/DocumentosPendentes');
    }

    /**
     * Envia o documento do cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/PUT-api-v4-Cliente-DocumentosPendentes
     * @return Array
     */
    public function documentoEnviar($documento)
    {
        return $this->http->put('api/v4/Cliente/DocumentosPendentes', ['form_params' => $documento]);
    }

    /**
     * Faz merge nas informações do cliente.
     *
     * @param Array $cliente
     * @return Array
     */
    public function setCliente($cliente)
    {
        try {

            if ( ! $this->cliente_is_valid($cliente) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->cliente = array(
                'Nome'                  => '',
                'Documento'             => '',
                'TipoPessoa'            => '',
                'Email'                 => '',
                'Endereco'              => '',
                'Telefones'             => '',
                'Usuario'               => '',
                'DataNascimento'        => '',
                'UrlNotificacao'        => '',
                'InscricaoEstadual'     => '',
                'InscricaoMunicipal'    => '',
                'Cupom'                 => ''
            );

            $this->cliente = array_merge($this->cliente, $cliente);
            return $this->cliente;

        } catch (\Exception $e) {
            return 'Erro ao definir o cliente. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $cliente
     * @return Boolean
     */
    public function cliente_is_valid($cliente)
    {
        return ! (
            empty($cliente['Nome']) OR
            empty($cliente['Documento']) OR
            empty($cliente['TipoPessoa']) OR
            empty($cliente['Email']) OR
            empty($cliente['Endereco']) OR
            empty($cliente['Telefones']) OR
            empty($cliente['Usuario'])
        );
    }
}
