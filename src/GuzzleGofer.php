<?php declare(strict_types=1);

namespace Kirkaracha\GuzzleGofer;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;

class GuzzleGofer
{
    const METHOD_DELETE = 'DELETE';
    const METHOD_GET    = 'GET';
    const METHOD_PATCH  = 'PATCH';
    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';

    const SEND_FORM_HEADER = [
        self::METHOD_PATCH,
        self::METHOD_POST,
        self::METHOD_PUT
    ];

    /** @var string $baseUri */
    protected $baseUri;

    /** @var Client $client */
    protected $client;

    /** @var bool $httpErrors */
    protected $httpErrors;

    public function __construct()
    {
        $this->httpErrors = config('guzzle-gofer.throw_http_errors');
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Make a new Guzzle Client
     *
     * @param string $baseUri
     * @param array $customOptions
     */
    public function makeClient(string $baseUri, array $customOptions = [])
    {
        $options = [
            'base_uri' => $baseUri
        ];

        if (count($customOptions) > 0) {
            array_merge($options, $customOptions);
        }

        $this->setClient(new Client($options));
    }

    /**
     * @param string $method
     * @return array
     */
    public function makeHeaders(string $method)
    {
        $headers = [
            'Accept'       => 'application/json',
            'Content-type' => 'application/json'
        ];

        if (in_array($method, self::SEND_FORM_HEADER)) {
            $headers['Content-type'] = 'application/x-www-form-urlencoded';
        }

        return $headers;
    }

    /**
     * @param string $path
     * @param array $data
     * @return mixed
     */
    public function deleteRequest(string $path, array $data)
    {
        $method = self::METHOD_DELETE;

        return $this->performRequest($path, $method, $data);
    }

    /**
     * @param string $uri
     * @param array $queries
     * @return mixed
     */
    public function getRequest(string $uri, array $queries = [])
    {
        $method = self::METHOD_GET;

        $data = !empty ($queries) ? ['query' => $queries] : null;

        return $this->performRequest($uri, $method, $data);
    }

    /**
     * @param string $uri
     * @param array $data
     * @return mixed
     */
    public function patchRequest(string $uri, array $data)
    {
        $method = self::METHOD_PATCH;

        return $this->performRequest($uri, $method, $data);
    }

    /**
     * @param string $uri
     * @param array $data
     * @return mixed
     */
    public function postRequest(string $uri, array $data)
    {
        $method = self::METHOD_POST;

        return $this->performRequest($uri, $method, $data);
    }

    /**
     * @param string $uri
     * @param array $data
     * @return mixed
     */
    public function putRequest(string $uri, array $data)
    {
        $method = self::METHOD_PUT;

        return $this->performRequest($uri, $method, $data);
    }

    /**
     * @param string $url
     * @param string $method
     * @param null $data
     * @return mixed
     */
    public function performRequest(string $url, string $method, $data = null)
    {
        $headers = $this->makeHeaders($method);

        try {
            $psr7Request = new Request($method, $url, $headers, $data);

            $response = $this->client->send($psr7Request);
        } catch (ConnectException $e) {
            $response = 'ConnectException: ' . $e->getMessage();
        } catch (ClientException $e) {
            $response = 'ClientException: ' . $e->getMessage();
        } catch (ServerException $e) {
            $response = 'ServerException: ' . $e->getMessage();
        } catch (Exception $e) {
            $response = 'Exception: ' . $e->getMessage();
        }

        return $response;
    }

    /**
     * @param string $baseUri
     * @param string $path
     * @return string
     */
    public function getFullUrl(string $baseUri, string $path)
    {
        return $baseUri . $path;
    }
}
