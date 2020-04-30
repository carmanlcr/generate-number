<?php

namespace App\Http\Controllers\DB_ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\DB_ADMIN_MODEL\Db_admin_campaing;
use App\DB_ADMIN_MODEL\Db_admin_genere;
use App\DB_ADMIN_MODEL\Db_admin_rrss;
use App\DB_ADMIN_MODEL\Db_admin_task;
use App\DB_ADMIN_MODEL\Db_admin_task_detail;
use App\FacebookModel\Campaing;
use App\FacebookModel\Task_Grid;
use App\FacebookModel\Task_Grid_Detail;
class TaskController extends Controller
{
    public function index(){
    	$rrss= Db_admin_rrss::where('active',1)->get();
    	$date = Carbon::now();
        $dateFormatBD = $date->format('Y-m-d H:m:s');

    	return view('admin.index')
    			->with('rrss',$rrss)
    			->with('dateCurrent',$dateFormatBD);
    	
    }

    public function indexApi(){
        $campaing = DB::connection('db_admin')->table('db_admin_tasks')
                        ->join('db_admin_campaings','db_admin_campaings.campaings_id','=','db_admin_tasks.campaings_id')
                        ->join('db_admin_generes','db_admin_generes.generes_id','=','db_admin_tasks.generes_id')
                        ->join('db_admin_rrss','db_admin_rrss.rrss_id','=','db_admin_tasks.rrss_id')
                        ->join('db_admin_tasks_detail','db_admin_tasks_detail.tasks_id','=','db_admin_tasks.tasks_id')
                        ->join('facebook.users as fbusers','fbusers.users_id','=','db_admin_tasks_detail.users_id')
                        ->whereRaw('db_admin_rrss.rrss_id = 1')
                        ->select(DB::raw('db_admin_tasks.tasks_id,db_admin_rrss.name as Red_Social, db_admin_campaings.name as campana, db_admin_generes.name as genero, fbusers.username as user, db_admin_tasks.date_publication as fecha, db_admin_tasks.image,IFNULL(db_admin_tasks.quantity_groups,0) as quantity_groups, IFNULL(db_admin_tasks.quantity_min,0) as quantity_min, db_admin_tasks.active'))
                        ->orderBy('db_admin_tasks.date_publication','DESC')
                        ->get();
        $taskInstagram = DB::connection('db_admin')->table('db_admin_tasks')
                        ->join('db_admin_campaings','db_admin_campaings.campaings_id','=','db_admin_tasks.campaings_id')
                        ->join('db_admin_generes','db_admin_generes.generes_id','=','db_admin_tasks.generes_id')
                        ->join('db_admin_rrss','db_admin_rrss.rrss_id','=','db_admin_tasks.rrss_id')
                        ->join('db_admin_tasks_detail','db_admin_tasks_detail.tasks_id','=','db_admin_tasks.tasks_id')
                        ->join('instagram.users as igusers','igusers.users_id','=','db_admin_tasks_detail.users_id')
                        ->whereRaw('db_admin_rrss.rrss_id = 2')
                        ->select(DB::raw('db_admin_tasks.tasks_id,db_admin_rrss.name as Red_Social, db_admin_campaings.name as campana, db_admin_generes.name as genero, igusers.username as user, db_admin_tasks.date_publication as fecha, db_admin_tasks.image,IFNULL(db_admin_tasks.quantity_groups,0) as quantity_groups, IFNULL(db_admin_tasks.quantity_min,0) as quantity_min, db_admin_tasks.active'))
                        ->orderBy('db_admin_tasks.date_publication','DESC')
                        ->get();
        $tasks=$campaing->merge($taskInstagram);
    	return datatables()
    		->of($tasks)
    		->addColumn('btn','admin/actions')
            ->addColumn('active',function($item){
                return $item->active ? 1 : 0;
            })
            ->addColumn('image', function($tasks){
                if($tasks->image != null){
                    $url= asset('images/'.$tasks->image);
                    return '<img src="'.$url.'" border="0" width="60" class="img-rounded" align="center" />';    
                }else{
                    return '<span>Sin Imagen</span>';    
                }
            })->rawColumns(['btn','image'])
            ->make(true)
    		;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'rrss_id' => 'required|numeric',
            'campaings_id' => 'required|numeric',
            'generes_id' => 'required|numeric',
            'date_publication' => 'required|date',
            'phrase' => 'required',
            'users_id[]' => 'numeric',
        ]);
        
       

       $name = null;
       $isFanPage = $request->isFanPage == null ? 0 : $request->isFanPage;
       $isGroups = $request->isGroups == null ? 0 : $request->isGroups;
        if($request->hasFile('image')){
            $file=$request->file('image');
            $name=time().'-'.$file->getClientOriginalName();
            $file->move(public_path('images'),$name);
        }
        $form_data = array(
            'rrss_id' => $request->rrss_id,
            'campaings_id' => $request->campaings_id,
            'generes_id' => $request->generes_id,
            'date_publication' => $request->date_publication,
            'phrase' => $request->phrase,
            'image' => $name,
            'isFanPage' => $isFanPage,
            'isGroups' => $isGroups,
            'quantity_min' => $request->quantity_min
        );
        $form_data['quantity_groups'] = $request->quantity_groups == null ? 0 : $request->quantity_groups;
        $task = Db_admin_task::create($form_data);
        foreach ($request->users_id as $key => $value) {
            $detail = array(
                'users_id' => $value,
                'tasks_id' => $task->tasks_id
            );

            Db_admin_task_detail::create($detail);
        }

        //Registrar en Facebook
        if($request->rrss_id == 1){
            $generes = Db_admin_genere::find($request->generes_id);
            $form_data_Facebook = array(
            'categories_id' => $request->campaings_id,
            'generes_id' => $generes->generes_id_fb,
            'date_publication' => $request->date_publication,
            'phrase' => $request->phrase,
            'image' => $name,
            'isFanPage' => $isFanPage,
            'isGroups' => $isGroups,
            'quantity_groups' => $form_data['quantity_groups'],
            'quantity_min' => $request->quantity_min,
            'db_admin_tasks_id' => $task->tasks_id 
            );

            $task_Facebook = Task_Grid::create($form_data_Facebook);

            foreach ($request->users_id as $key => $value) {
                $form_data_detail_Facebook = array(
                    'users_id' => $value,
                    'tasks_grid_id' => $task_Facebook->tasks_grid_id
                );

                Task_Grid_Detail::create($form_data_detail_Facebook);
            }
        }
        \Session::flash('flash_message', 'Se ha creado la tarea con exito');
        return redirect()->back();
        //$this->validate($request,[ 'nombre'=>'required', 'resumen'=>'required', 'npagina'=>'required', 'edicion'=>'required', 'autor'=>'required', 'npagina'=>'required', 'precio'=>'required']);
        //Libro::create($request->all());
        //return redirect()->route('libro.index')->with('success','Registro creado satisfactoriamente');
    }

    public function getGeneresOfTheCampaing(Request $request){
        if($request->ajax()){
            $generes = Db_admin_genere::where('campaings_id','=',$request->campaings_id)->get();
            $generesArray[0] = "SIN GENERO";
            foreach ($generes as $gen) {
                $generesArray[$gen->generes_id] =  $gen->name;

            }
            if(count($generesArray) > 0) unset($generesArray[0]);
            return response()->json($generesArray);
        }
    }

    public function getUsersForCategories(Request $request){

        if($request->ajax()){

            //Traer usuarios que no esten bloqueados para la categoría
            if($request->rrss_id == 1){
               $campaing = Campaing::with(['user' => function($query){
                        $query->whereNotExists(function($query1){
                            $query1->select(DB::raw(1))
                            ->from('users_block')
                            ->whereRaw('users_block.users_id = users.users_id AND users_block.active = 1');
                        });
                    }])->find($request->campaings_id);
                foreach($campaing->user as $users){
                    if(false !== filter_var(trim($users->username), FILTER_VALIDATE_EMAIL)){
                        $username = substr(trim($users->username),0,-4);
                    }else{
                        $username = trim($users->username);
                    }
                    $arrayUsers[$users->users_id] = $username;
                }

                return response()->json($arrayUsers); 
            }else if($request->rrss_id == 2){
                 
                $campaing = CampaingIg::with(['user' => function($query){
                        $query->whereNotExists(function($query1){
                            $query1->select(DB::raw(1))
                            ->from('users_blocK')
                            ->whereRaw('users_block.users_id = users.users_id AND users_block.active = 1');
                        });
                    }])->find($request->campaings_id);
                foreach($campaing->user as $users){
                    if(false !== filter_var(trim($users->username), FILTER_VALIDATE_EMAIL)){
                        $username = substr(trim($users->username),0,-4);
                    }else{
                        $username = trim($users->username);
                    }
                    $arrayUsers[$users->users_id] = $username;
                }

                return response()->json($arrayUsers);
            } 
        }   
    }

    public function getCampaingForRrss(Request $request){
        if($request->ajax()){
            $rrss_ids = Db_admin_rrss::with('campaing')->find($request->idRrss);
        
            
            foreach ($rrss_ids->campaing as $rrss) {
                $arrayCampaing[$rrss->campaings_id] = $rrss->name;
            }

            return response()->json($arrayCampaing);
        }

            
    }
    	
   
}
