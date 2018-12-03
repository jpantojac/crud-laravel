<?php

namespace App\Http\Controllers\API;

use App\APIProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client();
       $res = $client->request('POST', 'http://localhost:8000/oauth/token', 
       [
    'json' => ['username' => 'julianpc@gmail.com',
    'password' => '123456',
   'grant_type' => 'password',
   'client_id' => '2',
   'client_secret' => 'jvogBdcKnmaBCcZrpP4ducYhdpnlLZqXjGN7mUdn']

]);

   $contents = $res->getBody();
   $token=(json_decode($contents , true));
   $acces_token = $token['access_token'];
   
   ////
   $client2 = new \GuzzleHttp\Client();
   $res=$client2->request('GET', 'http://localhost:8000/api/products', [
    'headers' => [
        'Authorization' => 'Bearer '.$acces_token,
        'Accept'     => 'application/json',
    ]
    ]);
    $contents =$res->getBody();
    $arrayData=(json_decode($contents , true));
    $products = $arrayData['data'];
    //print_r($products);

    return view('APIproducts.index',compact('products'));
   
        //print_r($products);
        //return view('APIproducts.index',compact('products'));
       // ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function show(APIProduct $aPIProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(APIProduct $aPIProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, APIProduct $aPIProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(APIProduct $aPIProduct)
    {
        //
    }
}
