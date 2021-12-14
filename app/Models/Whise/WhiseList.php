<?php

namespace App\Models\Whise;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhiseList extends Model
{
    use HasFactory;

    public $filters=[
      'address'=>'',
      'purposeStatus'=>''
    ];
}
