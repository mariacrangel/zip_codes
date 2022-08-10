<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use App\Http\Resources\SettlementResource;
use Illuminate\Http\Request;

class ZipCodesController extends Controller
{

    /**
     * Display the from model.
     *
     * @param  \App\Models\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function show($zip_code)
    {
        $municipalities = Settlement::getMunicipalitiesByZipCode($zip_code);
        
        if(count($municipalities) > 0)
        {
            $result = ["zip_code" => $zip_code, 
            "locality" => strtoupper(change_character($municipalities[0]->city)), 
            "federal_entity" => ["key" => $municipalities[0]->municipality_code, "name" => strtoupper(change_character($municipalities[0]->federal_entity)), "code" => null],
            "settlements" =>  SettlementResource::collection(Settlement::getByKey($zip_code)),
            "municipality" => ["key" => $municipalities[0]->municipality_code, "name" => strtoupper(change_character($municipalities[0]->municipality))]];
            return  $result;
        }else {
            return ["404" => "NOT FOUND"];
        }
        
    }
}
