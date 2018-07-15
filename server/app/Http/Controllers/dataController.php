<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\data;
use App\User;

class dataController extends Controller
{
	public function index(){
        $datas = DB::table('data')
            ->orderBy('updated_at','desc')
            ->join('users', 'data.user_id', '=', 'users.id')
            ->select('data.*', 'users.name')
            ->paginate(20);
        return $datas;
	}

    public function dataStore(request $request){

    	$data = new data;
    	$data->data = $request->data;
    	$data->user_id = $request->user_id;
    	$data->save();
    	return ["result" => 1];
    }
}
