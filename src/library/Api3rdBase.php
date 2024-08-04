<?php
namespace budimanlai\library;

use Yii;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;
use yii\base\Exception;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use budimanlai\helpers\QueryHelper;

class Api3rdBase {
    public $baseUrl;
    public $api_key;
    public $category;
    public $path = "/";
    public $user_id;
    
    private $_request;
    private $_headers;
    private $_response;
    private $_targetUrl;
    
    public function getHeaders() {
        return [
            'content-type' => 'application/json',
        ];
    }
    
    public function parseError($data) {
        $message = ArrayHelper::getValue($data, 'message');
        return $message;
    }
    
    public function patch($endpoint, $params = []) {
        $this->_headers = $this->getHeaders();
        $this->_request = $params;
        $this->_targetUrl = $this->baseUrl . $this->path . $endpoint;
        
        $start_time = microtime(true);
        $log_id = $this->addLog($this->user_id, 'patch');
        try {
            
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $response = $client->createRequest()
                ->setFormat(Client::FORMAT_JSON)
                ->setMethod('PATCH')
                ->addHeaders($this->_headers)
                ->setData($this->_request)
                ->setUrl($this->_targetUrl)
                ->send();

            $end_time = microtime(true);
            $latency = $end_time - $start_time;
        
            $this->_response = $response->data;
            $this->addResponse($log_id, $response->data, $latency);
            
            if ($response->isOk) {
                return $response->data;
            } else {
                throw new \Exception($this->parseError($response->data));
            }
        } catch (Exception | InvalidParamException | BadRequestHttpException $e) {
            $end_time = microtime(true);
            $latency = $end_time - $start_time;
            
            $this->addException($log_id, $e->getMessage(), $latency);
            throw new \Exception($e->getMessage());
        }
    }
    
    public function delete($endpoint, $params = []) {
        $this->_headers = $this->getHeaders();
        $this->_request = $params;
        $this->_targetUrl = $this->baseUrl . $this->path . $endpoint;
        
        $start_time = microtime(true);
        $log_id = $this->addLog($this->user_id, 'delete');
        try {
            
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $response = $client->createRequest()
                ->setFormat(Client::FORMAT_JSON)
                ->setMethod('DELETE')
                ->addHeaders($this->_headers)
                ->setData($this->_request)
                ->setUrl($this->baseUrl . $this->path . $endpoint)
                ->send();

            $end_time = microtime(true);
            $latency = $end_time - $start_time;
        
            $this->_response = $response->data;
            $this->addResponse($log_id, $response->data, $latency);
            
            if ($response->isOk) {
                return $response->data;
            } else {
                throw new \Exception($this->parseError($response->data));
            }
        } catch (Exception $e) {
            $end_time = microtime(true);
            $latency = $end_time - $start_time;
            
            $this->addException($log_id, $e->getMessage(), $latency);
            throw new \Exception($e->getMessage());
        } catch (InvalidParamException $e) {
            $end_time = microtime(true);
            $latency = $end_time - $start_time;
            
            $this->addException($log_id, $e->getMessage(), $latency);
            throw new \Exception($e->getMessage());
        }
    }
    
    public function post($endpoint, $params) {
        $this->_headers = $this->getHeaders();
        $this->_request = $params;
        $this->_targetUrl = $this->baseUrl . $this->path . $endpoint;
        
        $start_time = microtime(true);
        $log_id = $this->addLog($this->user_id, 'post');
        try {
            
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $response = $client->createRequest()
                ->setFormat(Client::FORMAT_JSON)
                ->setMethod('POST')
                ->addHeaders($this->_headers)
                ->setData($this->_request)
                ->setUrl($this->baseUrl . $this->path . $endpoint)
                ->send();

            $end_time = microtime(true);
            $latency = $end_time - $start_time;
        
            $this->_response = $response->data;
            $this->addResponse($log_id, $response->data, $latency);
            
            if ($response->isOk) {
                return $response->data;
            } else {
                throw new Exception($this->parseError($response->data));
            }
        } catch (Exception | InvalidParamException | BadRequestHttpException $e) {
            $end_time = microtime(true);
            $latency = $end_time - $start_time;
            
            $this->addException($log_id, $e->getMessage(), $latency);
            throw new \Exception($e->getMessage());
        }
    }
    
    public function postForm($endpoint, $params) {
        $this->_headers = $this->getHeaders();
        $this->_request = $params;
        $this->_targetUrl = $this->baseUrl . $this->path . $endpoint;
        
        $start_time = microtime(true);
        $log_id = $this->addLog($this->user_id, 'post');
        try {
            
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $response = $client->createRequest()
                ->setMethod('POST')
                ->addHeaders($this->_headers)
                ->setData($this->_request)
                ->setUrl($this->baseUrl . $this->path . $endpoint)
                ->send();

            $end_time = microtime(true);
            $latency = $end_time - $start_time;
        
            $this->_response = $response->data;
            $this->addResponse($log_id, $response->data, $latency);
            
            if ($response->isOk) {
                return $response->data;
            } else {
                throw new Exception($this->parseError($response->data));
            }
        } catch (Exception | InvalidParamException | BadRequestHttpException $e) {
            $end_time = microtime(true);
            $latency = $end_time - $start_time;
            
            $this->addException($log_id, $e->getMessage(), $latency);
            throw new \Exception($e->getMessage());
        }
    }
    
    public function get($endpoint, $params) {
        $this->_headers = $this->getHeaders();
        $this->_request = $params;
        $this->_targetUrl = $this->baseUrl  . $this->path . $endpoint;
        
        if (!empty($params)) {
            $query = parse_url($this->_targetUrl, PHP_URL_QUERY);
            if ($query) {
                $this->_targetUrl.= '&' . http_build_query($params);
            } else {
                $this->_targetUrl.= '?' . http_build_query($params);
            }   
        }
            
        $start_time = microtime(true);
        $log_id = $this->addLog($this->user_id, 'get');
        
        try {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $response = $client->createRequest()
                ->setFormat(Client::FORMAT_JSON)
                ->setMethod('GET')
                ->addHeaders($this->_headers)
                ->setUrl($this->_targetUrl)
                ->send();

            $end_time = microtime(true);
            $latency = $end_time - $start_time;
        
            $this->_response = $response->data;
            $this->addResponse($log_id, $response->data, $latency);
            
            if ($response->isOk) {
                return $response->data;
            } else {
                throw new \Exception($this->parseError($response->data));
            }
        } catch (Exception | InvalidParamException | BadRequestHttpException $e) {
            $end_time = microtime(true);
            $latency = $end_time - $start_time;
            
            $this->addException($log_id, $e->getMessage(), $latency);
            throw new \Exception($e->getMessage());
        }
    }
    
    public function getHeaderReq() { return $this->_headers; }
    public function getRequest() { return $this->_request; }
    public function getResponse() { return $this->_response; }
    
    public function addLog($reff_id, $method) {
        QueryHelper::insert('api_3rd_log', [
            'category' => $this->category,
            'created_datetime' => date("Y-m-d H:i:s"),
            'method' => $method,
            'url' => $this->_targetUrl,
            'reff_id' => $reff_id,
            'headers' => Json::encode($this->_headers),
            'request_log' => Json::encode($this->_request),
        ]);
        
        return Yii::$app->db->getLastInsertID();
    }
    
    public function addException($log_id, $message, $latency = null) {
        QueryHelper::update('api_3rd_log', [
            'response_log' => Json::encode([
                'message' => $message,
            ]),
            'latency' => $latency
        ], 'id = :ID', [
            ':ID' => $log_id
        ]);
    }
    public function addResponse($log_id, $response, $latency = null) {
        QueryHelper::update('api_3rd_log', [
            'response_log' => Json::encode($response),
            'latency' => $latency
        ], 'id = :ID', [
            ':ID' => $log_id
        ]);
    }
}