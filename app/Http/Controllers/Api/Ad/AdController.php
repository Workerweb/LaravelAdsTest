<?php

namespace App\Http\Controllers\Api\Ad;

use App\Http\Controllers\Api\BaseController as Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Interfaces\AdRepositoryInterface;
class AdController extends Controller
{
    private $adRepository;

    public function __construct(AdRepositoryInterface $adRepository) 
    {
        $this->adRepository = $adRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $result = $this->adRepository->getAllAdsWithPagination($request->all());
        }
        catch(\Exception $e){
           return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($result, 'Список объявлений');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $this->validate($request, [
            'name' => 'required|string|max:200',
            'description' => 'required|string|max:1000',
            'price' => 'required|integer',
            'photos' => 'required|max:3',
            'photos.*' => 'required|array:url',
            'photos.*.url' => 'required|url',
        ]);
        try{
            $result = $this->adRepository->createAd($validData);
        }
        catch(\Exception $e){
           return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($result, 'Объявление успешно сохранено', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd($request->input('fields'));
        try{
            if ($request->input('fields')) {
                $ad = $this->adRepository->getAdByIdWithAdditionalInfo($id);
            } else {
                $ad = $this->adRepository->getAdById($id);
            }
        }
        catch(\Exception $e){
           return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($ad, 'Объявление');
    }
}
