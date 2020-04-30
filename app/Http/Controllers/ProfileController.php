<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\DB_ADMIN_MODEL\Db_admin_operator;
use App\DB_ADMIN_MODEL\Db_admin_users_create;
use App\DB_ADMIN_MODEL\Db_admin_users_create_detail;
use App\DB_ADMIN_MODEL\Db_admin_ethnicity;
use App\DB_ADMIN_MODEL\Db_admin_phone;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    protected $vpnLatino = array(
            'Mexico #23','Mexico #20','Mexico #25','Mexico #28','Mexico #24','Mexico #21',
            'Mexico #22','Mexico #12','Mexico #19','Mexico #16','Mexico #26','Mexico #39',
            'Mexico #44','Mexico #18','Costa Rica#16','Costa rica #19','Costa rica #8','Costa rica #15',
            'Costa rica #11','Costa rica #9','Costa rica #17','Chile #11','Chile #12','Chile #8',
            'Chile #10','Chile #9','Chile #13','Chile #7','Chile #16','Argentina #24',
            'Argentina #8','Argentina #9','Argentina #23','Argentina #20','Argentina #17',
            'Argentina #12','Argentina #14','Argentina #13','Argentina #11','Argentina #28',
            'Argentina #15','Argentina #16','Argentina #18','Argentina #19','Argentina #10',
            'Argentina #25','Argentina #22','Brazil #13','Brazil #14','Brazil #15',
            'Brazil #16','Brazil #17','Brazil #18','Brazil #19','Brazil #20','Brazil #21',
            'Brazil #22','Brazil #23','Brazil #24','Brazil #25','Brazil #26','Brazil #27',
            'Brazil #28','Brazil #29','Brazil #30','Brazil #31','Brazil #32','Brazil #33','Brazil #34',
            'Brazil #35','Brazil #36','Brazil #37','Brazil #38','Brazil #39','Brazil #40',
            'Brazil #41','Brazil #42','Brazil #43'
        );

    protected $vpnUS = array(
        'United States #3873','United States #3982','United States #3946','United States #2879',
        'United States #3088','United States #3017','United States #3951','United States #3117',
        'United States #4363','United States #2889','United States #4361','United States #3033',
        'United States #3900','United States #3945','United States #3106','United States #3207',
        'United States #3944','United States #3339','United States #3872','United States #1474',
        'United States #4333','United States #3747','United States #3746','United States #1472',
        'United States #1472','United States #1473','United states #1475','United States #1475',
        'United States #2481','United States #2481','United states #2482','United States #2483',
        'United States #2484','United States #2485','United States #2486','United States #2487',
        'United States #2488','United States #2489','United States #2490','United States #2491',
        'United States #2492','United States #2493','United States #2494','United States #2495',
        'United States #2496','United States #2497','United States #2498','United States #2499',
        'United States #2500','United States #2505','United States #2594','United States #2596',
        'United States #2597','United States #2598','United States #2599','United Sstate #2505',
        'United States #2506','United States #2507','United States #2508','United States #2510',
        'United States #2011','United States #2012','United States #2013','United States #2014',
        'United States #2015','United States #2016','United States #2017','United States #2018',
        'United States #2019','United States #2020','United States #2521','United States #2694',
        'United States #2696','United States #2697','United States #2698','United States #2699',
        'United States #2700','United States #2701','United States #2702','United States #2703',
        'United States #2704','United States #2704','United States #2705','United States #2706',
        'United States #2708','United States #2709','United States #2716','United States #2717',
        'United States #2714','United States #2715','United States #2726','United States #2727',
        'United States #2728','United States #2729','United States #2730','United States #2731',
        'United States #2732','United States #2733','United States #2750','United States #2751',
        'United States #2753','United States #2754','United States #2755','United States #2756',
        'United States #2757','United States #2758','United States #2759','United States #2760',
        'United States #2761','United States #2762','United States #2763','United States #2764',
        'United States #2765','United States #2766','United States #2767','United States #2768',
        'United States #2769','United States #2770','United States #2771','United States #2773',
        'United States #2774','United States #2775','United States #2776','United States #2777',
        'United States #2778','United States #2780','United States #3778','United States #3836',
        'United States #2734','United States #2735','United States #2738','United States #2739',
        'United States #2740','United States #2741','United States #2746','United States #2747',
        'United States #2748','United States #2749','United States #4785','United States #4836',
        'United States #4869','United States #4839','United States #4760','United States #4909',
        'United States #4935','United States #4938','United States #4408','United States #4409',
        'United States #4410','United States #4411','United States #4412','United States #4413',
        'United States #4414','United States #4415','United States #3109','United States #4639',
        'United States #3795','United States #5012','United States #4640','United States #3092',
        'United States #3641','United States #4934','United States #4343','United States #2519',
        'United States #3081','United States #3922','United States #3855','United States #3243',
        'United States #4684','United States #4230','United States #4929','United States #4536',
        'United States #5030','United States #3114','United States #3335','United States #4659',
        'United States #3085','United States #3116','United States #4251','United States #4552',
        'United States #4641','United States #5003','United States #3234','United States #3826',
        'United States #3153','United States #3558','United States #3568','United States #3246',
        'United States #3849','United States #5031','United States #4562','United States #4560',
        'United States #4627','United States #4525','United States #5024','United States #3415',
        'United States #502','United states #1577'
    );


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('profiles.index');
    }

    public function indexApi(){
        $users_create = DB::connection('db_admin')->table('db_admin_users_create')
                        ->join('db_admin_phones','db_admin_phones.phones_id','=','db_admin_users_create.phones_id')
                        ->join('db_admin_operators','db_admin_operators.operators_id','=','db_admin_phones.operators_id')
                        ->select(DB::raw('db_admin_users_create.users_create_id,db_admin_users_create.full_name,db_admin_users_create.password,db_admin_phones.phone,db_admin_users_create.email,IF(db_admin_users_create.gender=1,"Mujer","Hombre") as gender, db_admin_users_create.email,db_admin_users_create.vpn,db_admin_users_create.active, db_admin_users_create.create_fb,db_admin_users_create.create_ig,db_admin_users_create.create_tw'))
                        ->paginate(1000)->toArray();
        return  response()->json(['users' => $users_create]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operadoras = Db_admin_operator::where('active',1)->get();
        $etnia = Db_admin_ethnicity::where('active',1)->get();

        //Elegir un numero random para crear el genero
        $numrand = rand(1,2);
        return view('profiles.addProfile.addProfile')
            ->with('operadoras',$operadoras)
            ->with('etnia',$etnia)
            ->with('genere',$numrand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       
         $validate = $request->validate([
            'phone' => 'required|max:13',
            'number_sim' => 'required|numeric',
            'pin_simcard' => 'required|numeric|max:5',
            'puk_simcard' => 'required|numeric',
            'operadora' => 'required|numeric',
            'etnia' => 'required|numeric',
            'genere' => 'required',
            'fPerfil' => 'required|image',
            'fPortada' => 'required|image'
        ]);
        //validar el genero
        $request->genere = $request->genere == 1 ? true : false;
        //Crear el nombre de manera aleatoria correspondiente al genero y la etnia
        $name = DB::connection('db_admin')->table(DB::raw('db_admin_names na, db_admin_names as ne'))
        ->where('na.gender','=',$request->genere)
        ->where('na.ethnicitys_id','=',$request->etnia)
        ->where('ne.ethnicitys_id','=',$request->etnia)
        ->orderByRaw('RAND() LIMIT 1')
        ->select('na.first_name','ne.last_name')
        ->get();
		
        if($request->hasFile('fPerfil')){
            $file=$request->file('fPerfil');
			$extension = $request->file('fPerfil')->extension();
			if($extension == "jpeg"){
				$image = imagecreatefromjpeg($file);
			}else if($extension == "png"){
				$image = imagecreatefrompng($file);
			}
      
            $filter = (new Filter($image))->frozen();
            $namePe='(1)-'.time().'-'.$file->getClientOriginalName();
            $image_resize = Image::make($filter->getImage());
			$image_resize->resize(190,190);
            $image_resize->save(public_path('images/profiles/'.$namePe));

        }
        if($request->hasFile('fPortada')){
            $file=$request->file('fPortada');
            $namePo='(2)-'.time().'-'.$file->getClientOriginalName();
            $extension = $request->file('fPortada')->extension();
			if($extension == "jpeg"){
				$image = imagecreatefromjpeg($file);
			}else if($extension == "png"){
				$image = imagecreatefrompng($file);
			}
            $filter = (new Filter($image))->retro();
            $image_resize = Image::make($filter->getImage());
            $image_resize->resize(851,315);              
            $image_resize->save(public_path('images/profiles/'.$namePo));

        }
        if($request->hasFile('fAdicional')){
            $file=$request->file('fAdicional');
            $nameA='(3)-'.time().'-'.$file->getClientOriginalName();
            $file->move(public_path('images/profiles'),$nameA);
        }
        //Setear valor de simcard si no fue agregado
        $request->sim_card_number = $request->sim_card_number == 0 || $request->sim_card_number == ''  ? intval(2147483647) : $request->sim_card_number;
        
        //Crear array para insertar en 
        $form_data_phone = array(
            'phone' => $request->phone,
            'sim_card_number' => $request->sim_card_number,
            'pin_simcard' => $request->pin_simcard,
            'puk_simcard' => $request->puk_simcard,
            'number_sim' => $request->number_sim,
            'operators_id' => $request->operadora,
        );
        
        //Ingresar telefono a la base de datos
        $phone = Db_admin_phone::create($form_data_phone);     

        if($request->etnia == 1){
            $vpn = $this->vpnLatino[array_rand($this->vpnLatino)];
        }else if($request->etnia == 2){
            $vpn = $this->vpnUS[array_rand($this->vpnUS)];
        }else{
            $vpn = $this->vpnLatino[array_rand($this->vpnLatino)];
        }

        $form_data = array(
            'full_name' => $name[0]->first_name.' '.$name[0]->last_name,
            'phones_id' => $phone->phones_id,
            'gender' => $request->genere,
            'date_of_birth' => $this->fecha_aleatoria(),
            'password' => strtoupper($name[0]->first_name{0}).'1234567'.strtoupper($name[0]->last_name{0}),
			'ethnicitys_id' => $request->etnia,
            'vpn' => $vpn
        );
        $user_create = Db_admin_users_create::create($form_data);

        $form_data_users_create_detail = array(
            'fPerfil' => $namePe,
            'fPortada' => $namePo,
            'fAdicional' => $nameA,
            'users_create_id' => $user_create->users_create_id
        );
        Db_admin_users_create_detail::create($form_data_users_create_detail);
        \Session::flash('flash_message', 'Se agrego correctamente');
        return redirect()->route('profileAdd');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $usuario = Db_admin_users_create::find($id);

        $phone = Db_admin_phone::find($usuario->phones_id);

        $detail = Db_admin_users_create_detail::where("users_create_id","=",$usuario->users_create_id)->get();

        $operadoras = Db_admin_operator::where('active',1)->get();
        $generos = array("0" => "Hombre", "1" => "Mujer");
        $etnia = Db_admin_ethnicity::where('active',1)->get();
        //Elegir un numero random para crear el genero
        return view('profiles.editProfile.editProfile')
            ->with('operadoras',$operadoras)
            ->with('etnia',$etnia)
            ->with('usuario',$usuario)
            ->with('phone',$phone)
            ->with('detail',$detail)
            ->with('generos',$generos);
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
        $validate = $request->validate([
            'phone' => 'required|max:13',
            'number_sim' => 'required|numeric',
            'pin_simcard' => 'required|numeric|max:5',
            'puk_simcard' => 'required|numeric',
            'operadora' => 'required|numeric',
            'etnia' => 'required|numeric',
            'gender' => 'required|numeric',
        ]);

        //update users_create
        $usuario = Db_admin_users_create::find($id);
        $usuario->full_name = $request->full_name;
        $usuario->vpn = $request->vpn;

        $usuario->active = $request->active == 'on' ? true : false;
        $usuario->gender = $request->gender == 1 ? true: false;
        if(!is_null($request->genere)){
            $request->genere = $request->genere == 1 ? true : false;
            $usuario->genere = $request->genere;
        }
        $usuario->ethnicitys_id = $request->etnia;
        $usuario->save();

        //Update phone
        $request->sim_card_number = $request->sim_card_number == 0 || $request->sim_card_number == ''  ? intval(2147483647) : $request->sim_card_number;

        $phone = Db_admin_phone::find($usuario->phones_id);
        $phone->phone = $request->phone;
        $request->sim_card_number = is_null($request->sim_card_number) || $request->sim_card_number == 0 || $request->sim_card_number == ''  ? intval(2147483647) : $request->sim_card_number;
        $phone->sim_card_number = $request->sim_card_number;
        $phone->number_sim = $request->number_sim;
        $phone->pin_simcard = $request->pin_simcard;
        $phone->puk_simcard = $request->puk_simcard;
        $phone->operators_id = $request->operadora;
        $phone->save();

        //update users_detail
		$form = array();

        if($request->hasFile('fPerfil')){
            $file=$request->file('fPerfil');
			$extension = $request->file('fPerfil')->extension();
			if($extension == "jpeg"){
				$image = imagecreatefromjpeg($file);
			}else if($extension == "png"){
				$image = imagecreatefrompng($file);
			}
            $filter = (new Filter($image))->frozen();
            $namePe='(1)-'.time().'-'.$file->getClientOriginalName();
            $image_resize = Image::make($filter->getImage());
			$image_resize->resize(190,190);
            $image_resize->save(public_path('images/profiles/'.$namePe));
			$form['fPerfil'] = $namePe;
        }
        if($request->hasFile('fPortada')){
            $file=$request->file('fPortada');
            $namePo='(2)-'.time().'-'.$file->getClientOriginalName();
           $extension = $request->file('fPortada')->extension();
			if($extension == "jpeg"){
				$image = imagecreatefromjpeg($file);
			}else if($extension == "png"){
				$image = imagecreatefrompng($file);
			}
            $filter = (new Filter($image))->retro();
            $image_resize = Image::make($filter->getImage());
            $image_resize->resize(851,315);              
            $image_resize->save(public_path('images/profiles/'.$namePo));
			$form['fPortada'] = $namePo;

        }
        if($request->hasFile('fAdicional')){
            $file=$request->file('fAdicional');
            $nameA='(3)-'.time().'-'.$file->getClientOriginalName();
            $file->move(public_path('images/profiles'),$nameA);
			$form['fAdicional'] = $nameA;
        }

        $detail = Db_admin_users_create_detail::updateOrCreate(["users_create_id" => $id],
                $form);
        \Session::flash('flash_message', 'Se actualizo correctamente');
        return redirect()->route('profileIndex');

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

    public function fecha_aleatoria($formato = "Y-m-d", $limiteInferior = "1970-01-01", $limiteSuperior = "1995-12-30"){
        // Convertimos la fecha como cadena a milisegundos
        $milisegundosLimiteInferior = strtotime($limiteInferior);
        $milisegundosLimiteSuperior = strtotime($limiteSuperior);

        // Buscamos un número aleatorio entre esas dos fechas
        $milisegundosAleatorios = mt_rand($milisegundosLimiteInferior, $milisegundosLimiteSuperior);

        // Regresamos la fecha con el formato especificado y los milisegundos aleatorios
        return date($formato, $milisegundosAleatorios);
    }
}

class Filter {
    /**
     * @var resource
     */
    
    private $image;
    
    /**
     * Directory for image assets.
     * @var string
     */
    
    private $assetDirectory;

    /**
     * run constructor
     * @param resource &$image GD image resource
     */
    
    public function __construct(&$image) {
        
        $this->image = $image;
        
        $this->assetDirectory = dirname(dirname(dirname(__FILE__))) . '/assets/';
    }
    
    /**
     * Get the current image resource
     * 
     * @return resource
     */
    
    public function getImage() {
        
        return $this->image;
    }

    public function bubbles() {
        
        $dest = imagecreatefromjpeg($this->assetDirectory . "pattern4.jpg");

        $x = imagesx($this->image);
        $y = imagesy($this->image);

        $x2 = imagesx($dest);
        $y2 = imagesy($dest);

        $thumb = imagecreatetruecolor($x, $y);
        imagecopyresized($thumb, $dest, 0, 0, 0, 0, $x, $y, $x2, $y2);

        imagecopymerge($this->image, $thumb, 0, 0, 0, 0, $x, $y, 20);
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 40);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -10);

        return $this;
    }

    public function colorise() {
        
        $dest = imagecreatefromjpeg($this->assetDirectory . "pattern5.jpg");

        $x = imagesx($this->image);
        $y = imagesy($this->image);

        $x2 = imagesx($dest);
        $y2 = imagesy($dest);

        $thumb = imagecreatetruecolor($x, $y);
        imagecopyresized($thumb, $dest, 0, 0, 0, 0, $x, $y, $x2, $y2);

        imagecopymerge($this->image, $thumb, 0, 0, 0, 0, $x, $y, 40);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -25);
        
        return $this;
    }

    public function sepia() {
        
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 100, 50, 0);
        
        return $this;
    }

    public function sepia2() {
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, -10);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -20);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 60, 30, -15);

        return $this;
    }

    public function sharpen() {
        
        $gaussian = array(
                array(1.0, 1.0, 1.0),
                array(1.0, -7.0, 1.0),
                array(1.0, 1.0, 1.0)
        );
        imageconvolution($this->image, $gaussian, 1, 4);
        
        return $this;
    }

    public function emboss() {
        
        $gaussian = array(
                array(-2.0, -1.0, 0.0),
                array(-1.0, 1.0, 1.0),
                array(0.0, 1.0, 2.0)
        );
        
        imageconvolution($this->image, $gaussian, 1, 5);
        
        return $this;
    }

    public function cool() {
        
        imagefilter($this->image, IMG_FILTER_MEAN_REMOVAL);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -50);
        
        return $this;
    }

    public function old() {
        
        $dest = imagecreatefromjpeg($this->assetDirectory . "bg1.jpg");

        $x = imagesx($this->image);
        $y = imagesy($this->image);

        $x2 = imagesx($dest);
        $y2 = imagesy($dest);

        $thumb = imagecreatetruecolor($x, $y);
        imagecopyresized($thumb, $dest, 0, 0, 0, 0, $x, $y, $x2, $y2);

        imagecopymerge($this->image, $thumb, 0, 0, 0, 0, $x, $y, 30);
        
        return $this;
    }

    public function old2() {
        
        $dest = imagecreatefromjpeg($this->assetDirectory . "pattern1.jpg");

        $x = imagesx($this->image);
        $y = imagesy($this->image);

        $x2 = imagesx($dest);
        $y2 = imagesy($dest);

        $thumb = imagecreatetruecolor($x, $y);
        imagecopyresized($thumb, $dest, 0, 0, 0, 0, $x, $y, $x2, $y2);

        imagecopymerge($this->image, $thumb, 0, 0, 0, 0, $x, $y, 40);
        
        return $this;
    }

    public function old3() {
        
        imagefilter($this->image, IMG_FILTER_CONTRAST, -30);

        $dest = imagecreatefromjpeg($this->assetDirectory . "pattern3.jpg");

        $x = imagesx($this->image);
        $y = imagesy($this->image);

        $x2 = imagesx($dest);
        $y2 = imagesy($dest);

        $thumb = imagecreatetruecolor($x, $y);
        imagecopyresized($thumb, $dest, 0, 0, 0, 0, $x, $y, $x2, $y2);

        imagecopymerge($this->image, $thumb, 0, 0, 0, 0, $x, $y, 50);
        
        return $this;
    }

    public function light() {
        
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 10);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 100, 50, 0, 10);
        
        return $this;
    }

    public function aqua() {
        
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 70, 0, 30);
        
        return $this;
    }

    public function fuzzy() {
        
        $gaussian = array(
                array(1.0, 1.0, 1.0),
                array(1.0, 1.0, 1.0),
                array(1.0, 1.0, 1.0)
        );

        imageconvolution($this->image, $gaussian, 9, 20);
        
        return $this;
    }

    public function boost() {
        
        imagefilter($this->image, IMG_FILTER_CONTRAST, -35);
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 10);
        
        return $this;
    }

    public function boost2() {
        imagefilter( $this->image, IMG_FILTER_CONTRAST, -35);
        imagefilter( $this->image, IMG_FILTER_COLORIZE, 25, 25, 25);

        return $this;
    }

    public function gray() {
        
        imagefilter($this->image, IMG_FILTER_CONTRAST, -60);
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        
        return $this;
    }

    public function antique() {
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 0);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -30);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 75, 50, 25);

        return $this;
    }

    public function blackwhite() {
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 10);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -20);

        return $this;
    }

    public function blur() {
        imagefilter($this->image, IMG_FILTER_SELECTIVE_BLUR);
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -15);
        imagefilter($this->image, IMG_FILTER_SMOOTH, -2);

        return $this;
    }

    public function vintage() {
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 10);
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 40, 10, -15);

        return $this;
    }
    
    public function concentrate() {
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($this->image, IMG_FILTER_SMOOTH, -10);

        return $this;
    }
    
    public function hermajesty() {
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, -10);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -5);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 80, 0, 60);

        return $this;
    }

    public function everglow() {
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, -30);
        imagefilter($this->image, IMG_FILTER_CONTRAST, -5);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 30, 30, 0);

        return $this;
    }

    public function freshblue() {
        imagefilter($this->image, IMG_FILTER_CONTRAST, -5);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 20, 0, 80, 60);

        return $this;
    }

    public function tender() {
        imagefilter($this->image, IMG_FILTER_CONTRAST, 5);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 80, 20, 40, 50);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 40, 40, 100);
        imagefilter($this->image, IMG_FILTER_SELECTIVE_BLUR);

        return $this;
    }

    public function dream() {
        imagefilter($this->image, IMG_FILTER_COLORIZE, 150, 0, 0, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 50, 0, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);

        return $this;
    }

    public function frozen() {
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, -15);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 0, 100, 50);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 0, 100, 50);
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);

        return $this;
    }

    public function forest() {
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 0, 150, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 0, 150, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_SMOOTH, 10);

        return $this;
    }

    public function rain() {
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($this->image, IMG_FILTER_MEAN_REMOVAL);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 80, 50, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_SMOOTH, 10);

        return $this;
    }

    public function orangepeel() {
        imagefilter($this->image, IMG_FILTER_COLORIZE, 100, 20, -50, 20);
        imagefilter($this->image, IMG_FILTER_SMOOTH, 10);
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, -10);
        imagefilter($this->image, IMG_FILTER_CONTRAST, 10);
        imagegammacorrect($this->image, 1, 1.2 );

        return $this;
    }

    public function darken() {
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, -50);

        return $this;
    }

    public function summer() {
        imagefilter($this->image, IMG_FILTER_COLORIZE, 0, 150, 0, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 25, 50, 0, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE);

        return $this;
    }

    public function retro() {
        imagefilter($this->image, IMG_FILTER_GRAYSCALE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 100, 25, 25, 50);

        return $this;
    }

    public function country() {
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, -30);
        imagefilter($this->image, IMG_FILTER_COLORIZE, 50, 50, 50, 50);
        imagegammacorrect($this->image, 1, 0.3);

        return $this;
    }

    public function washed() {
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 30);
        imagefilter($this->image, IMG_FILTER_NEGATE);
        imagefilter($this->image, IMG_FILTER_COLORIZE, -50, 0, 20, 50);
        imagefilter($this->image, IMG_FILTER_NEGATE );
        imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 10);
        imagegammacorrect($this->image, 1, 1.2);

        return $this;
    }

}