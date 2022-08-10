<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementType extends Model
{
    use HasFactory;
    /**
     * Table
     * @var string
    */

    protected $table = 'settlement_types';
    /**
     * Primary Key
     * @var string
    */
    protected $primaryKey = 'key';

    protected $fillable = ['name'];
    protected $hidden = ['key','created_at', 'updated_at'];

    /**
     * The model shouldn't be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * return all settlement types
     */
    public function getAll()
    {
        return SettlementType::all();
    }

    /**
     * return Settlement type by key
     */

     public function getByKey($key)
     {
        return SettlementType::where('key', $key)->get();
     }

     /**
     * Get the Settlement that owns the Settlement type.
     */
    public function settlement()
    {
        return $this->hasOne(Settlement::class, 'key');
    }
}
