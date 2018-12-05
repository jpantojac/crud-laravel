<?php

namespace App\Http\Controllers\API;

use App\APIProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;

class APIProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($products);

        // Define how many items we want to be visible in each page
        $perPage = 5;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('apiproducts.index',['products'=> $paginatedItems]);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('APIProducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $request->validate([
    'name' => 'required',
    'detail' => 'required',
    ]);

    //APIProduct::create($request->all());
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
    //$body['name'] = $request->input('name');
    //$body['detail'] = $request->input('detail');;

    $res=$client2->request('POST', 'http://localhost:8000/api/products', [
        'headers' => [
        'Authorization' => 'Bearer '.$acces_token,
        'Accept'     => 'application/json'],
        'json'=> [
            'name' => $request->name,
            'detail' => $request->detail
           ]

    ]);


    $contents =$res->getBody();
    $arrayData=(json_decode($contents , true));
    $products = $arrayData['data'];    

    return redirect()->route('apiproducts.index')
                ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->segment(2);

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

         //request the product with id
         $client2 = new \GuzzleHttp\Client();
        $res=$client2->request('GET', 'http://localhost:8000/api/products/'.$id, [
        'headers' => [
        'Authorization' => 'Bearer '.$acces_token,
        'Accept'     => 'application/json'],
        ]);


    $contents =$res->getBody();
    $arrayData=(json_decode($contents , true));
    $product = $arrayData['data'];    
    //print_r($product);
        return view('apiproducts.show',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $id = $request->segment(2);

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

         //request the product with id
         $client2 = new \GuzzleHttp\Client();
        $res=$client2->request('GET', 'http://localhost:8000/api/products/'.$id, [
        'headers' => [
        'Authorization' => 'Bearer '.$acces_token,
        'Accept'     => 'application/json'],
        ]);


    $contents =$res->getBody();
    $arrayData=(json_decode($contents , true));
    $product = $arrayData['data'];    
    //print_r($product);
        return view('apiproducts.edit',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->segment(2);
        //APIProduct::create($request->all());
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

        $client2 = new \GuzzleHttp\Client();
        //$body['name'] = $request->input('name');
        //$body['detail'] = $request->input('detail');;

        $res=$client2->request('PUT', 'http://localhost:8000/api/products/'.$id, [
            'headers' => [
            'Authorization' => 'Bearer '.$acces_token,
            'Accept'     => 'application/json'],
            'json'=> [
            'name' => $request->name,
            'detail' => $request->detail
            ]
        ]);

        $contents =$res->getBody();
        $arrayData=(json_decode($contents , true));
        $products = $arrayData['data'];    
         //print_r($products); 
         return redirect()->route('apiproducts.index')
                ->with('success','Product edited successfully.');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\APIProduct  $aPIProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->segment(2);
        //APIProduct::create($request->all());
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

        $client2 = new \GuzzleHttp\Client();
        //$body['name'] = $request->input('name');
        //$body['detail'] = $request->input('detail');;

        $res=$client2->request('DELETE', 'http://localhost:8000/api/products/'.$id, [
            'headers' => [
            'Authorization' => 'Bearer '.$acces_token,
            'Accept'     => 'application/json']
        ]);

        $contents =$res->getBody();
        $arrayData=(json_decode($contents , true));
        $products = $arrayData['data'];    
         //print_r($products); 
         return redirect()->route('apiproducts.index')
                ->with('success','Product edited successfully.');    
    }
}
