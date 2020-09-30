<?php


class ApiProvider
{
    private $accessToken;

    public function __construct($token)
    {
        $this->accessToken = $token;
    }

    public function call($method, $args) {
        $ch = curl_init("https://api.telegram.org/bot" . $this->accessToken . "/$method");

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));

        $data = curl_exec($ch);

        return json_decode($data, true);
    }
}