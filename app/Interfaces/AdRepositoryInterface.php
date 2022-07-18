<?php

namespace App\Interfaces;

interface AdRepositoryInterface 
{
    public function getAllAdsWithPagination($sort = array());
    public function getAdById($id);
    public function getAdByIdWithAdditionalInfo($id);
    public function createAd(array $data);
}