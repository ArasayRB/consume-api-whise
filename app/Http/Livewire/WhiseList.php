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
    'statusSale'=>''
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
  * Filter by Status Sale
  *
  * @return array
  */
  public function getStatusSaleProperty()
  {
    $filtered= $this->estates->where('statusSale',$this->filters['statusSale']);

    return $filtered;
  }

  /**
  * Filter by
  *
  * @return array
  */
  public function getFilterProperty()
  {
    $filtered= $this->estates->where('statusSale',$this->filters['statusSale']);

    return $filtered->where('address',$this->filters['address']);
  }

  /**
  * Search by
  *
  * @return array
  */
  public function searchBy()
  {
    if ($this->filters['address']!='' && $this->filters['statusSale']=='') {
      return self::getAddressProperty();//$this->estates->where('address',$this->filters['address']);
    }
    elseif ($this->filters['statusSale']!='' && $this->filters['address']=='') {
      return self::getStatusSaleProperty();
    }
    elseif ($this->filters['statusSale']!='' && $this->filters['address']!='') {
      return self::getFilterProperty();
    }
    return '';
  }

  /**
  * Get Http Header using Bearer token.
  *
  * @return array
  */
  public static function getHttpHeaders()
  {
      $bearerToken = "".env('API_WHISE_TOKEN')."";

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
  * Set status to Property
  *
  * @return void
  */
  public function setStatusProperty()
  {
    for ($i=0; $i < count($this->estates); $i++) {
      if ($this->estates[$i]->purposeStatus->id=='3' || $this->estates[$i]->purposeStatus->id=='17') {
        $this->estates[$i]->statusSale='sold';
      }
      elseif ($this->estates[$i]->purposeStatus->id=='5' || $this->estates[$i]->purposeStatus->id=='16') {
        $this->estates[$i]->statusSale='under-offer';
      }
      elseif ($this->estates[$i]->purposeStatus->id=='12') {
        $this->estates[$i]->statusSale='owner-s';
      }
      elseif ($this->estates[$i]->purposeStatus->id=='13') {
        $this->estates[$i]->statusSale='owner-r';
      }
      elseif ($this->estates[$i]->purposeStatus->id=='1' || $this->estates[$i]->purposeStatus->id=='15') {
        $this->estates[$i]->statusSale='for-sale';
      }
      else {
        $this->estates[$i]->statusSale='';
      }
    }
  }

  /**
  * Connection to api rest whise using GuzzleHttp.
  *
  * @return array
  */
  public function mount()
  {
      $client = new Client(self::getHttpHeaders());

      $url = "".env('API_WHISE_URL')."";

      $response = $client->post($url, [
        'json' => self::getParams()
      ]);

      $responseBody = json_decode($response->getBody());
      $this->estates=collect($responseBody->estates);
      self::setStatusProperty();
      $this->status=collect(self::getStatusProperty());

      $results=self::searchBy();

      if ($results!='') {
        return $results;
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
            'paginate'=> $paginate->paginate(10),
            'selected'=>$this->status->keys(),
            'api_url'=>env('API_WHISE_URL')
        ]);
  }
}
