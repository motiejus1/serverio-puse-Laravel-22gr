<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    //create ir edit
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $csrf = $request->csrf; //apsaugos token(zetonas)
        
        if(isset($csrf) && !empty($csrf) && $csrf == "123456789") {
            $clients = Client::paginate(10);
            return response()->json($clients);
        }

        return response()->json(array(
            'erorr' => 'Authentification failed'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;
        
        // $client = Client::create([
        //     'name' => $request->client_name,
        //     'surname' => $request->client_surname,
        //     'description' => $request->client_description
        // ]);

        $client->name = $request->client_name;
        $client->surname = $request->client_surname;
        $client->description = $request->client_description;

        $client->save();

        return response()->json(array(
            'success' => 'Client added',
            'name' => $client->name,
            'surname' => $client->surname
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
