<?php

namespace App\Models\Livewire;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhiseList extends Model
{
    use HasFactory;

    /**
    * Declare properties
    * @param array
    */
    public static $status;
    public static $filters;

    public function _construct():void
    {
      self::$status=[
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

      self::$filters=[
        'name'=>'',
        'statusSale'=>''
      ];
    }

    /**
    * Set values to @param filter
    * @return void
    */
    public static function setFilters(array $filters):void
    {
      self::$filters=$filters;
    }

    /**
    * Filter by Name
    *
    * @param object $estates
    * @param string $filter
    *
    * @return object
    */
    public static function getNameProperty(object $estates, string $filter):object
    {
      $filtered= $estates->where('name',$filter);

      return $filtered;
    }

    /**
    * Filter by Status Sale
    *
    * @param object $estates
    * @param string $filter
    *
    * @return object
    */
    public static function getStatusSaleProperty(object $estates, string $filter):object
    {
      $filtered= $estates->where('statusSale',$filter);

      return $filtered;
    }

    /**
    * Filter by
    *
    * @param object $estates
    * @param array $filter
    *
    * @return object
    */
    public static function getFilterProperty(object $estates, array $filter):object
    {
      $filtered= $estates->where('statusSale',$filter['statusSale']);

      return $filtered->where('name',$filter['name']);
    }

    /**
    * Set status to Property
    *
    * @return object
    */
    public static function setStatusProperty(object $estates):object
    {
      for ($i=0; $i < count($estates); $i++) {
        if ($estates[$i]->purpose_status=='3' || $estates[$i]->purpose_status=='17') {
          $estates[$i]->statusSale='sold';
        }
        elseif ($estates[$i]->purpose_status=='5' || $estates[$i]->purpose_status=='16') {
          $estates[$i]->statusSale='under-offer';
        }
        elseif ($estates[$i]->purpose_status=='12') {
          $estates[$i]->statusSale='owner-s';
        }
        elseif ($estates[$i]->purpose_status=='13') {
          $estates[$i]->statusSale='owner-r';
        }
        elseif ($estates[$i]->purpose_status=='1' || $estates[$i]->purpose_status=='15') {
          $estates[$i]->statusSale='for-sale';
        }
        else {
          $estates[$i]->statusSale='';
        }
      }
      return $estates;
    }

    /**
    * Get Default Filters Configuration
    * @return array
    */
    public static function getDefaultFiltersConfig():array
    {
      return $filters=[
        'name'=>'',
        'statusSale'=>''
      ];
    }

    /**
    * Get filters values
    * @return array
    */
    public static function getFilters(array $filters=[]):array
    {
      if (count($filters)>0) {
        self::setFilters($filters);
      }else{
        $filters=self::getDefaultFiltersConfig();
        self::setFilters($filters);
      }

      return self::$filters;
    }

    /**
    * Set values to @param status
    * @return void
    */
    public static function setStatus(array $status):void
    {
      self::$status=$status;
    }

    /**
    * Get Default Status Configuration
    * @return array
    */
    public static function getDefaultStatusConfig():array
    {
      return $status=[
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
    }

    /**
    * Get @param status
    * @return array
    */
    public static function getStatus(array $status=[]):array
    {
      if (count($status)>0) {
        self::setStatus($status);
      } else {
        $status=self::getDefaultStatusConfig();
        self::setStatus($status);
      }

      return self::$status;
    }



    /**
    * Get Http Header using Bearer token.
    *
    * @return array
    */
    public static function getHttpHeaders():array
    {

        $headers = [
            'Content-Type' => 'application/json',
            'http_errors' => false,
        ];

        return $headers;
    }

    /**
    * Get Http Params.
    *
    * @return array
    */
    public static function getParams():array
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
}
