<?php

namespace App\Repositories;

use App\Interfaces\AdRepositoryInterface;
use App\Models\Ad;

class AdRepository implements AdRepositoryInterface 
{
    public function getAllAdsWithPagination($sort = array()) 
    {
        $query = Ad::query()->with('photos');

        if (isset($sort['column']) && isset($sort['direction'])) {
            $query->orderBy($sort['column'], $sort['direction']);
        }
        return $query->paginate(10);
    }

    public function getAdById($id) 
    {
        return Ad::select('id', 'name', 'price')->find($id);
    }

    public function getAdByIdWithAdditionalInfo($id) 
    {
        $fields = array(
            'id', 'name', 'price', 'description'
        );
        $query = Ad::query()
                    ->select($fields)
                    ->where('id', $id)
                    ->with('photos');
        $ad = $query->first();
        return $ad;
    }

    public function createAd(array $data) 
    {
        $ad = Ad::make($data);
            $ad->save();
            foreach ($data['photos'] as $key => $value) {
                $ad->photos()->create([
                    'ad_id' => $ad->id,
                    'url' => $value['url']
                ]);
            }
        return array('id' => $ad->id);
    }

}