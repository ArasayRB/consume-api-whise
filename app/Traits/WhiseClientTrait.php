<?php

namespace App\Traits;

use App\Models\Livewire\WhiseList as WhiseModel;
use Illuminate\Support\Facades\Http;
//use GuzzleHttp\Client;
//use GuzzleHttp\Exception\RequestException;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

trait WhiseClientTrait
{
  /**
  * Connection to api rest whise using ClientHttp Laravel by default.
  * @return \Illuminate\Http\Response
  */
  public function apiWithJWT()
  {
    $url = "".env('API_WHISE_URL')."";

    $response = Http::withHeaders(WhiseModel::getHttpHeaders())
                     ->withToken(''.env('API_WHISE_TOKEN').'')
                     ->post($url, [
                        'json' => WhiseModel::getParams(),
                    ]);

    return json_decode($response->getBody());
  }
}
