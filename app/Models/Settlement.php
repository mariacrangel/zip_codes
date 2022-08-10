<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SettlementType;

class Settlement extends Model
{
    use HasFactory;

    /**
     * Table
     * @var string
    */

    protected $table = 'settlements';
    /**
     * Primary Key
     * @var string
    */
    protected $primaryKey = 'zip_code';

    protected $fillable = ['key', 'name', 'zone'];
    protected $hidden = ['zip_code','city', 'type', 'municipality', 'created_at', 'updated_at'];

    /**
     * Get the federal municipality that owns the Settlement.
     */
    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality', 'key');
    }

    /**
     * Get the settlement type record associated with the settlement.
     */
    public function settlement_type()
    {
        return $this->hasOne(\App\Models\SettlementType::class, 'key', 'type');
    }

    public function getMunicipalitiesByZipCode($zip_code)
    {
           /* $municipalities = DB::table('settlements')
            ->join('municipalities', 'settlements.municipality', '=', 'municipalities.key')
            ->join('municipalities', 'settlements.entity', '=', 'municipalities.federal_entity')
            ->join('cities', 'cities.municipality', '=', 'municipalities.key')
            ->join('entities', 'municipalities.federal_entity', '=', 'entities.key')
            ->where('settlements.zip_code', '=', $zip_code)
            ->select('cities.name as city', 'municipalities.key as municipality_code', 'municipalities.name as municipality','entities.key as entity_code','entities.name as municipalities.federal_entity')
            ->distinct()
            ->get();
        return $municipalities;*/

        $municipalities = DB::select( DB::raw("select distinct settlements.zip_code, cities.name as city, municipalities.key as municipality_code, municipalities.name as municipality, entities.key as entity_code, entities.name as federal_entity
        from settlements inner join municipalities on settlements.municipality = municipalities.key and settlements.entity = municipalities.federal_entity 
        inner join cities on cities.municipality = municipalities.key and cities.entity = municipalities.federal_entity 
        inner join entities on  municipalities.federal_entity = entities.key where settlements.zip_code = :zip_code limit 1"), array(
            'zip_code' => $zip_code,
          ));
          return $municipalities;
         
    }

    public function getSettlementByZipCode($zip_code)
    {
            $settlements = DB::table('settlements')
            ->join('settlement_types', 'settlements.type', '=', 'settlement_types.key')
            ->where('settlements.zip_code', '=', $zip_code)
            ->select('settlements.key', 'settlements.name', 'settlements.zone', 'settlement_types.name')
            ->get();

            
        return $settlements;
    }

    /**
     * return Settlement  by key
     */

    public function getByKey($zip_code)
    {

        $sett =  Settlement::where('zip_code', $zip_code)->with('settlement_type')->get();
        
        return $sett;

    }
}
