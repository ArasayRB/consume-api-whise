<?php

namespace App\Http\Livewire;

use Livewire\Component;use GuzzleHttp\Client;
use Livewire\WithPagination;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Models\Whise\WhiseList as WhiseModel;

class WhiseList extends Component
{
  use WithPagination;

  public $estates;
  public $status;
  public $filters=[
    'address'=>'',
    'purposeStatus'=>''
  ];

  /**
  * Filter by Address
  *
  * @return array
  */
  public function getAddressProperty()
  {
    $filtered= $this->estates->where('address',$this->filters['address']);

    return $filtered;
  }

  /**
  * Get Http Header using Bearer token.
  *
  * @return array
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
  *
  * @return array
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
  *
  * @return array
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
  *
  * @return array
  */
  public function mount()
  {
      $client = new Client(self::getHttpHeaders());

      $url = "https://api.whise.eu/v1/estates/list";

      $response = $client->post($url, [
        'json' => self::getParams()
      ]);

      $responseBody = json_decode($response->getBody());
      $this->estates=collect($responseBody->estates);
      $this->status=collect(self::getStatusProperty());
      if ($this->filters['address']!='') {
        return self::getAddressProperty();//$this->estates->where('address',$this->filters['address']);
      }

      return $this->estates;
  }

  /**
  * Connection to api rest whise using GuzzleHttp.
  *
  * @return array
  */
  public function render()
  {
    //$filtered= $this->estates
    //return $filtered->all();
      $paginate=self::mount();
      return view('livewire.whise-list',[
            'paginate'=> $paginate->paginate(10)
        ]);
  }
}
