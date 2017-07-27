<?php

namespace App\Http\Controllers\Home;

use
    Illuminate\Http\Request;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\AreaModel;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//       print_r($request);exit;
        $id = $request->input('id');
         echo $id;
    }

}