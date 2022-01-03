<?php

namespace App\Http\Controllers;

use App\Traits\PropertyTrait;
use App\Models\Livewire\WhiseList as WhiseModel;
use App\Traits\WhiseClientTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WhiseClient_Controller extends Controller
{
  use PropertyTrait, WhiseClientTrait;

  /**
  * Connection to api rest whise using ClientHttp Laravel by default.
  * @return \Illuminate\Http\Response
  */
  public function whiseWithJWT()
  {
    $connection=$this->apiWithJWT();
    $estates=collect($connection->estates);
    $this->store($estates);
    return redirect()->route('dashboard');
  }
}
