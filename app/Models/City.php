<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    /**
     * Table name
     * @var string
     */

     protected $table = 'cities';

     /**
      * Primary Key
      * @var string
      */
     protected $primaryKey = 'key';

     /**
     * The model shouldn't be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the Municipality that owns the city.
     */
    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality', 'key');
    }

    

}
