<?php

namespace App\Services;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class ApiLinkService
{
    protected $log;

    public function __construct()
    {
        $this->log = customerLoggerHandle('requestApi');
    }

    /**
     * @param string $host
     * @param string $method
     * @param array $requestData
     * @param string $option
     * @param array $addHeaders
     * @param int $timeout
     * @return mixed
     * @throws ServiceException
     */
    public function getClient(string $host, string $method, array $requestData, $option = 'post', array $addHeaders = [], int $timeout = 60)
    {
        $this->log->debug(__METHOD__ . "[start]" . $host . $method);

        $headers = [];

        $headers = array_merge($addHeaders, $headers);

        $client = new Client([
            "base_uri" => $host,
            "timeout"  => $timeout,
            "headers"  => $headers,
        ]);

        $this->log->debug(__METHOD__ . "[request]", $requestData);

        if ($option == 'post') {
            $response = $client->post($method, ['form_params' => $requestData]);
        } else {
            $response = $client->get($method, ['query' => $requestData]);
        }

        return $this->parseResponse($response);
    }

    /**
     * @param $response
     * @return mixed
     * @throws ServiceException
     */
    private function parseResponse($response)
    {
        /** @var Response $response */
        if ($response->getStatusCode() == 200) {
            $responseContents = $response->getBody()->getContents();
            $rsData = json_decode($responseContents, true);
            $this->log->debug(__METHOD__ . "[response]", $rsData);

            return $rsData;
        } else {
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "失败");
        }
    }
}