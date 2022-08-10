<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    /**
     * Table name 
     * @var string
     */
    $protected $table = 'municipalities';

    /**
     * Primary Key
     * @var string
     */

     $protected $primaryKey = 'key';

    /**
     * The model shouldn't be timestamped.
     *
     * @var bool
     */
     public $timestamps = false;
    
     /**
     * Get the federal entity that owns the municipality.
     */
    public function entity()
    {
        return $this->belongsTo(Entity::class, 'federal_entity', 'key');
    }

    /**
     * Get the cities for the municipality.
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'municipality', 'key');
    }

    /**
     * Get the settlements for the municipality.
     */
    public function settlements()
    {
        return $this->hasMany(Settlement::class, 'municipality', 'key');
    }

    /**
     * return all Municipalities
     */
    public function getAllMunicipalities()
    {
        return Municipality::all();
        
    }

    /**
     * return Municipality By key
     */
    public function getAllMunicipalities($key)
    {
        return Municipality::where('key', $key)->get();
        
    }

    /**
     * return Municipality by key
     */

     public function getMunicipalityByEntity($entity)
     {
        retun Post::whereBelongsTo($entity, 'key')->get();
     }
}
