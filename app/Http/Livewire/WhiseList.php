<?php

namespace App\Http\Livewire;

use Livewire\Component;use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\WhiseClient_Controller;

class WhiseList extends Component
{
  public $estates;
  public $paginate;
  public $status;

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
  * Get Http Params.
  */
  public function getParams()
  {
     $params = [
       "filter"=> [
         "statusIds"=> [1],
         "DisplayStatusIds"=> [1,2,3,4,5],
         "estateIds"=> [],
         "IncludeGroupEstates"=> true,
         "LanguageId"=> "fr-BE"
       ]
     ];

     return $params;
  }

  /**
  *Get Status of Property
  */
  public function getStatusProperty()
  {
    $status=[
        'sold'=>[
          'card'=>'... w-82 max-w-full border border-gray-300 rounded-sm bg-gray-200',
          'text'=>''
        ],
        'owner-s'=>[
          'card'=>'... w-82 max-w-full border border-gray-300 rounded-sm bg-red-700',
          'text'=>'text-light'
        ],
        'owner-r'=>[
          'card'=>'... w-82 max-w-full border border-gray-300 rounded-sm bg-yellow-300',
          'text'=>''
        ],
        'for-sale'=>[
          'card'=>'... w-82 max-w-full border border-gray-300 rounded-sm bg-yellow-500',
          'text'=>''
        ],
        'under-offer'=>[
          'card'=>'... w-82 max-w-full border border-gray-300 rounded-sm bg-green-400',
          'text'=>''
        ],
        'other'=>[
          'card'=>'... w-82 max-w-full border border-gray-300 rounded-sm',
          'text'=>''
        ]
    ];

    return $status;
  }

  /**
  * Connection to api rest whise using GuzzleHttp.
  */
  public function mount()
  {
      $client = new Client(self::getHttpHeaders());

      $url = "https://api.whise.eu/v1/estates/list";

      $response = $client->post($url, [
        'json' => self::getParams()
      ]);

      $responseBody = json_decode($response->getBody());
      $this->estates=collect($responseBody->estates)->all();
      $this->paginate=collect($responseBody->totalCount);
      $this->status=collect(self::getStatusProperty());
  }

  public function render()
  {
      return view('livewire.whise-list',[
            'estates' => $this->estates,
            'paginate'=> $this->paginate
        ]);
  }
}
