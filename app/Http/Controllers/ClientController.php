<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Validator;

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
        
        $input = [
            'client_name'=> $request->client_name,
            'client_surname'=> $request->client_surname,
            'client_description'=> $request->client_description,
        ];

        $rules = [
            'client_name'=> 'required',
            'client_surname'=> 'required',
            'client_description'=> 'required',
        ];
   
        $validator = Validator::make($input, $rules);


        if($validator->fails()) {

            //zinuciu masyva, kuriose surasyta viskas, kas negerai
            //atvaizduoti zinuciu masyva prie kiekvieno input laukelio
            $errors = $validator->messages()->get('*'); //pasiima visu ivykusiu klaidu sarasa
            $client_array = array(
                'errorMessage' => "validator fails",
                'errors' => $errors
            );
        } else {

            $client = new Client;
            $client->name = $request->client_name;
            $client->surname = $request->client_surname;
            $client->description = $request->client_description;
        
            $client->save();//po isaugojimo momento

            $client_array = array(
                'successMessage' => "Client stored succesfuly",
                'clientId' => $client->id,
                'clientName' => $client->name,
                'clientSurname' => $client->surname,
                'clientDescription' => $client->description,
            );
    }

        $json_response =response()->json($client_array); 
        return $json_response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Client $client => id
    public function update(Request $request, $id)
    {
        //$client is not defined
        //$id

        $input = [
            'client_name'=> $request->client_name,
            'client_surname'=> $request->client_surname,
            'client_description'=> $request->client_description,
        ];

        $rules = [
            'client_name'=> 'required',
            'client_surname'=> 'required',
            'client_description'=> 'required',
        ];
   
        $validator = Validator::make($input, $rules);


        if($validator->fails()) {

            //zinuciu masyva, kuriose surasyta viskas, kas negerai
            //atvaizduoti zinuciu masyva prie kiekvieno input laukelio
            $errors = $validator->messages()->get('*'); //pasiima visu ivykusiu klaidu sarasa
            $client_array = array(
                'errorMessage' => "validator fails",
                'errors' => $errors
            );
        } else {

            $client = Client::find($id);//find suranda irasa pagal id
            $client->name = $request->client_name;
            $client->surname = $request->client_surname;
            $client->description = $request->client_description;
        
            $client->save();//po isaugojimo momento

            $client_array = array(
                'successMessage' => "Client stored succesfuly",
                'clientId' => $client->id,
                'clientName' => $client->name,
                'clientSurname' => $client->surname,
                'clientDescription' => $client->description,
            );
    }

        $json_response =response()->json($client_array); 
        return $json_response;
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
