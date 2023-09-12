<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait CpanelHttpClient
{

    /**
     * Realiza la consulta HTTP a la API de Cpanel
     * @method GET
     * @return object{
     *      status: boolean,
     *      messages: string | null,
     *      data:string | null,
     *      errors: array<string> | null,
     *      warnings:array<string> | null,
     *      metadata:{},
     * }
     */
    public function getRequest( string $url ): void
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $header = "Authorization: cpanel $this->cp_username:$this->cp_token";

        curl_setopt($ch, CURLOPT_HTTPHEADER, [ $header ]);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'Error:' . curl_error($ch));
        }
        curl_close($ch);

        $response = json_decode($result, true);

        if( (bool) ! $response['status'] ) {
            abort( Response::HTTP_INTERNAL_SERVER_ERROR, $response['errors'][0] );
        }
    }

    /**
     * Construye la url query para las peticiones de Mysql en Cpanel
     * @param  string $query
     * @param  array<string, string> $params
     * @return string
     */
    public function mysqlRequestUrl( string $query, array $params ): string
    {
        return $this->requestUrl( "$this->cp_url:$this->cp_port/execute/Mysql/$query", $params );
    }

    /**
     * requestUrl
     *
     * @param  mixed $url
     * @param  mixed $params
     * @return string
     */
    public function requestUrl( string $url, array $params ): string
    {
        $url = "$url?";
        foreach( $params as $param => $value ) {
            $url = "$url$param=$value&";
        }
        return substr($url, 0, -1);
    }
}