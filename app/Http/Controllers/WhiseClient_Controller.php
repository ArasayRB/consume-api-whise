<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class WhiseClient_Controller extends Controller
{
  /**
  * Get Http Header using Bearer token.
  */
  public static function getHttpHeaders()
  {
    $bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImlhdCI6MTYzODgxNzM3MH0.eyJzZXJ2aWNlQ29uc3VtZXJJZCI6MTg3LCJ0eXBlSWQiOjcsImNsaWVudElkIjoyNTkwLCJvZmZpY2VJZCI6NDM2OH0.wqcbLPs4I0YAa0HN4rxiV5S0waqx7SI2_Ckv_CwubJo';

    $headers = [
      'headers' => [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' .$bearerToken,
      ],
      'http_errors' => false,
    ];

    return $headers;
  }

  /**
  * Connection to api rest whise using GuzzleHttp.
  */
  public function apiWithJWT()
  {
    $client = new Client(self::getHttpHeaders());

    $url = "https://api.whise.eu/v1/estates/list";

    $params = [
      "filter"=> [
        "statusIds"=> [1],
        "DisplayStatusIds"=> [1,2,3,4,5],
        "estateIds"=> [],
        "IncludeGroupEstates"=> true,
        "LanguageId"=> "fr-BE"
      ],
      "Page"=> [
        "Limit"=> 10
      ]
    ];

    $response = $client->post($url, [
      'json' => $params
    ]);
    //$resp['statusCode'] = $response->getStatusCode();
    //$resp['bodyContents'] = $response->getBody()->getContents();
    //return $resp;

    $responseBody = json_decode($response->getBody());

    return $responseBody;//view('projects.apiwithkey', compact('responseBody'));
  }
}
