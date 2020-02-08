<?php

namespace App\Http\Controllers\Facebook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\DB_ADMIN_MODEL\Db_admin_campaing;
use App\DB_ADMIN_MODEL\Db_admin_genere;
use App\DB_ADMIN_MODEL\Db_admin_rrss;
use App\FacebookModel\Campaing;
use App\FacebookModel\User;
use App\FacebookModel\Vpn;

class FacebookController extends Controller{

	public function indexUserPost(){
		return view('facebook.user-post.index');
	}	

    public function getUserPost(){
    	$date = Carbon::now();
    	$dateTimePrevious = $date->subHour()->format('Y-m-d 00:00:00');
    	$dateD = $date->formatLocalized('%A %d %B %Y');
    	$postUser = DB::connection('facebook')->table('users')
            ->join('posts', function ($join) use ($dateTimePrevious) {
                    $join->on('posts.users_id', '=', 'users.users_id')
                    ->where('posts.created_at', '>=', $dateTimePrevious);
            })
            ->join('categories', 'posts.categories_id', '=', 'categories.categories_id')
            ->select(DB::raw('users.username, count(*) as cant, categories.name as categoria'))
            ->groupBy('users.username','categories.name')
            ->orderByRaw('categories.name ASC')
            ->get()->toArray();
        $countPublications = 0;
        foreach ($postUser as $value) {
            $countPublications += $value->cant;
        }
    	return response()->json(['post' => $postUser,'date' => $dateD, 'cantPost' => $countPublications]);

    }

    public function indexUserBlock(){
		return view('facebook.user-block.index');
	}

	public function getUserBlock(){
    	$blockUser = DB::connection('facebook')->table('users_block')
    		->join('users', 'users.users_id', '=', 'users_block.users_id')
    		->select('users.username','users_block.comentario')
    		->where('users_block.active','=',1)
    		->get()->toArray();

    	sort($blockUser);
    	return response()->json(['block' => $blockUser]);

    }

    public function getUsers(){

        $users = DB::connection('facebook')->table('users')
            ->join('vpn','vpn.vpn_id','=','users.vpn_id')
            ->join('users_categories','users_categories.users_id','=','users.users_id')
            ->join('categories','categories.categories_id','=','users_categories.categories_id')
            ->select(DB::raw('users.users_id,users.username, users.email, users.full_name, users.phone,users.password,users.creator,users.date_of_birth,users.active,users.sim_card_number,vpn.name as vpn,categories.name as categories'))
            ->paginate(1000)->toArray();
                
            return response()->json(['users' => $users]);
    }

    public function users(){
        return view('facebook.users.index');
    }

    public function edit($id){
        $usuario = User::with('campaing')->with(["users_block" => function($q){
                $q->where('users_block.active', '=', true);
        }])->where('users_id','=',$id)->first();
        $vpn = Vpn::all();  
        $campaings = Campaing::all();
        return view('facebook.edit-users.index')
                ->with('usuario',$usuario)
                ->with('vpn',$vpn)
                ->with('campaings',$campaings);
    }

    public function update(Request $request, $id){

        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'full_name' => 'required|',
            'phone' => 'required|numeric',
            'password' => 'required',
            'date_of_birth' => 'required|date',
            'active' => 'required',
            'sim_card_number' => 'required|numeric',
            'vpn_id' => 'required|numeric',
            'campaings_id' => 'required|numeric'
        ]);

        $user = User::with('campaing')->with('users_block')->find($id);

        if(is_null($request->users_block_id)){
            
           foreach ($user->users_block as $key => $value) {
               $value->update(["active" => 0]);
           }
        }
    
        $user->username = $request->username;
        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->date_of_birth = $request->date_of_birth;
        $user->active =  $request->active == 'on' ? true : false;
        $user->sim_card_number = $request->sim_card_number;
        $user->creator = $request->creator == null ? "" : $request->creator;
        $user->vpn_id = $request->vpn_id;
        $user->save();

        $user->campaing()->detach($user->campaing[0]->categories_id);
        $user->campaing()->attach($request->campaings_id);


        \Session::flash('flash_message', 'Se actualizo correctamente');
        return redirect()->route('users');
    }
}
