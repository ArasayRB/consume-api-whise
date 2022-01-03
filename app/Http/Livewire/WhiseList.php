<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Traits\PropertyTrait;
use App\Traits\WhiseClientTrait;
use App\Models\Livewire\WhiseList as WhiseModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class WhiseList extends Component
{
  use WithPagination, PropertyTrait, WhiseClientTrait;

  public $estates;
  public $status;
  public $filters=[
    'name'=>'',
    'statusSale'=>''
  ];

  /**
  * Search by
  *
  * @return array
  */
  public function searchBy()
  {
    if ($this->filters['name']!='' && $this->filters['statusSale']=='') {
      return WhiseModel::getNameProperty($this->estates,$this->filters['name']);
    }
    elseif ($this->filters['statusSale']!='' && $this->filters['name']=='') {
      return WhiseModel::getStatusSaleProperty($this->estates,$this->filters['statusSale']);
    }
    elseif ($this->filters['statusSale']!='' && $this->filters['name']!='') {
      return WhiseModel::getFilterProperty($this->estates,$this->filters);
    }
    return '';
  }

  /**
  * Set status to Property
  *
  * @return void
  */
  public function setStatusProperty():void
  {
    $this->estates=WhiseModel::setStatusProperty($this->estates);
  }

  /**
  * Connection to api rest whise using GuzzleHttp.
  *
  * @return array
  */
  public function mount()
  {
      //$connection=$this->apiWithJWT();
      $this->estates=$this->getProperties();//collect($connection->estates);
      self::setStatusProperty();
      $this->status=collect(WhiseModel::getStatus());

      //$this->store($this->estates, $this->status);

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
      $paginate=self::mount();
      return view('livewire.whise-list',[
            'paginate'=> $paginate->paginate(10),
            'selected'=>$this->status->keys()
        ]);
  }
}
