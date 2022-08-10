<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    /**
     * Table
     * @var string
    */

    protected $table = 'entities';
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
     * return all Entities
     */
    public function getAll()
    {
        return Entity::all();
    }

    /**
     * return Entity by key
     */

     public function getByKey($key)
     {
        return Entity::where('key', $key)->get();
     }

     /**
     * Get the municipalities for the federal entity.
     */
    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'federal_entity', 'key');
    }
}
