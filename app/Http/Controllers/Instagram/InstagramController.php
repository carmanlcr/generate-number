<?php

namespace App\Http\Controllers\Instagram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\InstagramModel\User;
use App\InstagramModel\Vpn;
use App\InstagramModel\Campaing;
class InstagramController extends Controller
{

	public function users(){
        return view('instagram.users.index');
    }

    public function getUsers(){

        $users = DB::connection('instagram')->table('users')
            ->join('vpn','vpn.vpn_id','=','users.vpn_id')
            ->join('users_categories','users_categories.users_id','=','users.users_id')
            ->join('categories','categories.categories_id','=','users_categories.categories_id')
            ->select(DB::raw('users.users_id,users.username, users.email, users.full_name, users.phone,users.password,users.creator,users.date_of_birth,users.active,users.sim_card_number,vpn.name as vpn,categories.name as categories'))
            ->paginate(1000)->toArray();
                
            return response()->json(['users' => $users]);
    }

    public function edit($id){
        $usuario = User::with('campaing')->where('users_id','=',$id)->first();
        $vpn = Vpn::all();
        $campaings = Campaing::all();
        return view('instagram.edit-users.index')
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

        $user = User::with('campaing')->find($id);
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
        return redirect()->route('usersInstagram');
    }
}
