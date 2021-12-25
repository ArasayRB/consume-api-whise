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
        'address'=>'',
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
    * Get Default Filters Configuration
    * @return array
    */
    public static function getDefaultFiltersConfig():array
    {
      return $filters=[
        'address'=>'',
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
