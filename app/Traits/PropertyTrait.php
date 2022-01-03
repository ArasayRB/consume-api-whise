<?php

namespace App\Traits;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait PropertyTrait
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  object  $estates
   * @return \Illuminate\Http\Response
   */
  public function store(object $estates)
  {
    foreach ($estates as $estate) {
      if ($estate->status->id===1 && !Property::where('reference_id', $estate->id)->exists()) {
        $property=new Property();
        $property->name=!isset($estate->address) ? "" : $estate->address;
        $property->purpose_status=!isset($estate->purposeStatus->id) ? "" : $estate->purposeStatus->id;
        $property->reference_id=!isset($estate->id) ? "" : $estate->id;
        $property->save();
      }
    }
  }

  /**
  * Get all properties
  * @return \Illuminate\Http\Response
  */
  public function getProperties()
  {
    return Property::all();
  }
}
