<?php

require_once 'aes.php';
require_once 'vendor/autoload.php';

class SASConnector{

    private $client;
    private $host;
    private $username;
    private $password;
    private $portal;
    private $base_url;
    private $aes;
    private $token;

    public function __construct($host, $username, $password, $portal='acp')
    {
        $this->aes = new AESController();
        $this->client = new GuzzleHttp\Client();
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
	$this->portal = $portal;
	$p = 'admin';
	if ($portal === 'ucp')
		$p = 'user';
        $this->base_url = 'http://'.$this->host.'/'.$p.'/api/index.php/api/';
	echo $this->base_url;
    }

    public function post($route, $payload, $withAuth = true){

        $json = json_encode($payload);
        $e_json = $this->aes::encrypt($json, 'abcdefghijuklmno0123456789012345');
        $res = $this->client->request('POST',$this->base_url.$route,
            [
                'headers' => [
                    'authorization' => 'Bearer '.$this->token
                    ],
                'json' => [
                    'payload' => $e_json
                ]
            ]
            );
        if ($res->getStatusCode() >= 200 && $res->getStatusCode()< 400)
            return $res->getBody();
        else
            return -1;
    }

    public function get($route, $withAuth = true){
        $res = $this->client->request('GET',$this->base_url.$route,
            [
                'headers' => [
                    'authorization' => 'Bearer '.$this->token
                ]
            ]
        );
        if ($res->getStatusCode() >= 200 && $res->getStatusCode()< 400)
            return $res->getBody();
        else
            return -1;
    }


	public function login(){
        $payload['username'] = $this->username;
        $payload['password'] = $this->password;
	$route = 'login';
	if ($this->portal === 'ucp')
		$route = 'auth/login';
        $res = $this->post($route, $payload, false);
        if ($res !== -1)
        {
            $t = json_decode($res);
            $this->token = $t->token;
        }
    }

}



