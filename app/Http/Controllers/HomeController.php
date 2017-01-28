<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Auth;
use PDF;
use DB;
use Fpdf;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\NameEquipment;
use App\Equipment;
use App\Equipmentdetail;

use App\Change_equipment;
use App\Change_equipmentdetail;
use App\Repair_equipment;
use App\Repair_equipmentdetail;
use App\Unrepair_equipment;
use App\Unrepair_equipmentdetail;

use App\Name_equipment_stock;
use App\Save_stock;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $equipment = Equipment::all();
   
        $unrepair_equipment = Unrepair_equipment::all();

    
        $num_change = DB::table('change_equipments');
        $num_change_and_repair = DB::table('repair_equipments')->union($num_change)->get();


       return view('project/index')->with('equipment',$equipment)
       ->with('unrepair_equipment',$unrepair_equipment) 
       ->with('num_change_and_repair',$num_change_and_repair)
       ;

    }




    public function stat()
    {
        $ym = date("Y-m-");
        // dd($ym);
        $count_change = DB::table('change_equipmentdetails')
        ->leftJoin('name_equipments','change_equipmentdetails.id','=','name_equipments.id')
        ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))->where('change_equipmentdetails.created_at','LIKE','%'.$ym.'%')
        ->groupBy('change_equipmentdetails.equiment')
        ->get();
        
        // dd($count_change);
       
       $count_repair = DB::table('Repair_equipmentdetails')
        ->leftJoin('name_equipments','Repair_equipmentdetails.id','=','name_equipments.id')
        ->select('Repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('Repair_equipmentdetails.created_at','LIKE',$ym.'%')
        ->groupBy('Repair_equipmentdetails.equiment')
        ->get();

       $count_unrepair = DB::table('Unrepair_equipmentdetails')
        ->leftJoin('name_equipments','Unrepair_equipmentdetails.id','=','name_equipments.id')
        ->select('Unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('Unrepair_equipmentdetails.created_at','LIKE',$ym.'%')
        ->groupBy('Unrepair_equipmentdetails.equiment')
        ->get();

        return view('project/page/stat')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair);
       

        
    }

    public function statt()
    {
       // dd(input::get('month'));
       $month = input::get('month');
       


        $count_change = DB::table('change_equipmentdetails')
        ->leftJoin('name_equipments','change_equipmentdetails.id','=','name_equipments.id')
        ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))->where('change_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('change_equipmentdetails.equiment')
        ->get();
        
        // dd($count_change);
       
       $count_repair = DB::table('Repair_equipmentdetails')
        ->leftJoin('name_equipments','Repair_equipmentdetails.id','=','name_equipments.id')
        ->select('Repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('Repair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('Repair_equipmentdetails.equiment')
        ->get();

       $count_unrepair = DB::table('Unrepair_equipmentdetails')
        ->leftJoin('name_equipments','Unrepair_equipmentdetails.id','=','name_equipments.id')
        ->select('Unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('Unrepair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('Unrepair_equipmentdetails.equiment')
        ->get();

        return view('project/page/stat')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair);
       

        
    }


    public function statprint()
    {
        $month = input::get('month');
       


        $count_change = DB::table('change_equipmentdetails')
        ->leftJoin('name_equipments','change_equipmentdetails.id','=','name_equipments.id')
        ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))->where('change_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('change_equipmentdetails.equiment')
        ->get();
        
        // dd($count_change);
       
       $count_repair = DB::table('Repair_equipmentdetails')
        ->leftJoin('name_equipments','Repair_equipmentdetails.id','=','name_equipments.id')
        ->select('Repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('Repair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('Repair_equipmentdetails.equiment')
        ->get();

       $count_unrepair = DB::table('Unrepair_equipmentdetails')
        ->leftJoin('name_equipments','Unrepair_equipmentdetails.id','=','name_equipments.id')
        ->select('Unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('Unrepair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('Unrepair_equipmentdetails.equiment')
        ->get();

       
        return view('project/page/statprint')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair);
    
    }



    public function statpdf()
    {
        $month = input::get('month');
       


        $count_change = DB::table('change_equipmentdetails')
        ->leftJoin('name_equipments','change_equipmentdetails.id','=','name_equipments.id')
        ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))->where('change_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('change_equipmentdetails.equiment')
        ->get();
        
        // dd($count_change);
       
       $count_repair = DB::table('Repair_equipmentdetails')
        ->leftJoin('name_equipments','Repair_equipmentdetails.id','=','name_equipments.id')
        ->select('Repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('Repair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('Repair_equipmentdetails.equiment')
        ->get();

       $count_unrepair = DB::table('Unrepair_equipmentdetails')
        ->leftJoin('name_equipments','Unrepair_equipmentdetails.id','=','name_equipments.id')
        ->select('Unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('Unrepair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('Unrepair_equipmentdetails.equiment')
        ->get();


        // return view('project/page/statpdf')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair);

        $pdf = PDF::loadView('project/page/statpdf',compact('count_change','count_repair','count_unrepair'));
        return $pdf->stream('equipment.pdf');
    
    }



    public function rereport($id)
    {
        $Eq = Equipment::where('id_equipment',$id)->first();
        $Eqd = Equipmentdetail::where('id_equipment',$id)->get();
        return view('project/page/print_eq')->with('Eq',$Eq)->with('Eqd',$Eqd);

    }


    public function getPDF($id)
    {
        $Eq = Equipment::where('id_equipment',$id)->first();
        $Eqd = Equipmentdetail::where('id_equipment',$id)->get();
        // return view('project/page/getpdf')->with('Eq',$Eq)->with('Eqd',$Eqd);
        $pdf = PDF::loadView('project/page/getpdf',compact('Eq','Eqd'));
        return $pdf->stream('equipment.pdf');

    }




    public function showw()
    {
       //  $equipment = Equipment::all();
   
       //  $unrepair_equipment = Unrepair_equipment::all();

    
       //  $num_change = DB::table('change_equipments');
       //  $num_change_and_repair = DB::table('repair_equipments')->union($num_change)->get();


       // return view('project/page/show')->with('equipment',$equipment)
       // ->with('unrepair_equipment',$unrepair_equipment) 
       // ->with('num_change_and_repair',$num_change_and_repair)
       // ;
        $equipment = Equipment::all();
        return view('project/page/show')->with('equipment',$equipment);
    }



    public function showequipment($id)
    {
        $Eq = Equipment::where('id_equipment',$id)->first();
        $Eqd = Equipmentdetail::where('id_equipment',$id)->get();
        
        return view('project/page/showequipment')->with('Eq',$Eq)->with('Eqd',$Eqd);
    }



    public function search(Request $query) 
    {
        $query=$query->Input('search');
        // $query = $da;
        // print_r($query);
        $equipment = Equipmentdetail::where('equipment','LIKE','%'.$query.'%')->get();
        $count = Equipmentdetail::where('equipment','LIKE','%'.$query.'%')->count();
        return view('project/page/showequipment', compact('equipment','count'));
    }

    public function record($id)
    { 

        $Eq = Equipment::where('id_equipment',$id)->first();
        $Eqd = Equipmentdetail::where('id_equipment',$id)->get();
        $count = Equipmentdetail::where('id_equipment',$id)->count();
        return view('project/page/record')->with('Eq',$Eq)->with('Eqd',$Eqd)->with('count',$count);
    }


////////////////////////////***********************////////////////////////////////

    public function fix()
    {
        $name_equipment = NameEquipment::all(); //name equipment for search

        $id_user = Auth::user()->id;
        $list_fix = Equipment::where('id_user',$id_user)->get();
        

        return view('project/page/fix')->with('name_equipment',$name_equipment)->with('list_fix',$list_fix);
    }

    public function detailfix($id)
    {
        $Eq = Equipment::where('id_equipment',$id)->first();
        $Eqd = Equipmentdetail::where('id_equipment',$id)->get();
        
        return view('project/page/detailfix')->with('Eq',$Eq)->with('Eqd',$Eqd);
    }
///***********************************//////***********************************///
    public function delete_fix($id)
    {
       $Eqd = Equipmentdetail::where('id_equipment',$id)->delete();
       $Eq = Equipment::where('id_equipment',$id)->delete();  
       return Redirect::to('fix');  
    }

    public function delete_detail_fix($id)
    {
        $Eqd = Equipmentdetail::find($id);  
        $Eqd->delete();

        $Eq = Equipment::where('id_equipment',$id)->first();
        $Eqd = Equipmentdetail::where('id_equipment',$id)->get();
        
        return view('project/page/detailfix')->with('Eq',$Eq)->with('Eqd',$Eqd);
    }

///***********************************//////***********************************///

///***********************************//////***********************************///
    public function edit_fix($id)
    {
       
       $Eq = Equipment::where('id_equipment',$id)->first();  
       
       return view('project/page/editfix')->with('Eq',$Eq); 
    }
    public function update_fix($id)
    {   
       // echo $id;
        $equipment = Equipment::where('id_equipment',$id)->first();   
        // echo $equipment;   
        $equipment->id_user = Auth::user()->id;   
        $equipment->phone_number = input::get('phone_number');  
        $equipment->num_room = input::get('num_room');
        // $date = date("Y-m-d"); 
        $equipment->date_in = date("Y-m-d");   
        $equipment->date_repair = input::get('date_repair');    
        $equipment->time_repair = input::get('time_repair');    
        $equipment->live = input::get('live');
        $equipment->note = input::get('note');
        $equipment->save();
        return Redirect::to('fix'); 
        //echo "string";
    }



    public function editEq_fix($id)
    {  
        $Eqd = Equipmentdetail::where('id',$id)->first();  
        return view('project/page/editfixequipment')->with('Eqd',$Eqd);
    }

    public function updateEq_fix(Request $data, $id)
    {  
        
            $logo = $data->file('eqpho0');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq0');
            $epdetail = $data->Input('eqdetail0');

            if($success)
            {
                $equipmentdetail = Equipmentdetail::where('id',$id)->first(); 
                $equipmentdetail->photo_repair = $filename;
                // $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            } 
      return Redirect::to('fix'); 
  
    }




///***********************************//////***********************************///

    public function savefix(Request $data)
    {   


        $equipment = new Equipment;       
        $equipment->id_user = Auth::user()->id;   
        $equipment->phone_number = input::get('phone_number');  
        $equipment->num_room = input::get('num_room');
        // $date = date("Y-m-d"); 
        $equipment->date_in = date("Y-m-d");   
        $equipment->date_repair = input::get('date_repair');    
        $equipment->time_repair = input::get('time_repair');    
        $equipment->live = input::get('live');
        $equipment->note = input::get('note');
        $equipment->save();


        $k=$data->Input('eq0');
        if($k!=null)
        {
            $logo = $data->file('eqpho0');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq0');
            $epdetail = $data->Input('eqdetail0');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }


        $a=$data->Input('eq1');
        if($a!=null)
        {
            $logo = $data->file('eqpho1');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq1');
            $epdetail = $data->Input('eqdetail1');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }


        $b=$data->Input('eq2');
        if($b!=null)
        {
            $logo = $data->file('eqpho2');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq2');
            $epdetail = $data->Input('eqdetail2');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }

        $c=$data->Input('eq3');
        if($c!=null)
        {
            $logo = $data->file('eqpho3');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq3');
            $epdetail = $data->Input('eqdetail3');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }        

        $d=$data->Input('eq4');
        if($d!=null)
        {
            $logo = $data->file('eqpho4');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq4');
            $epdetail = $data->Input('eqdetail4');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }

        $e=$data->Input('eq5');
        if($e!=null)
        {
            $logo = $data->file('eqpho5');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq5');
            $epdetail = $data->Input('eqdetail5');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }

        $f=$data->Input('eq6');
        if($f!=null)
        {
            $logo = $data->file('eqpho6');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq6');
            $epdetail = $data->Input('eqdetail6');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }


        $g=$data->Input('eq7');
        if($g!=null)
        {
            $logo = $data->file('eqpho7');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq7');
            $epdetail = $data->Input('eqdetail7');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }

        $h=$data->Input('eq8');
        if($h!=null)
        {
            $logo = $data->file('eqpho8');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq8');
            $epdetail = $data->Input('eqdetail8');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }

        $i=$data->Input('eq9');
        if($i!=null)
        {
            $logo = $data->file('eqpho9');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq9');
            $epdetail = $data->Input('eqdetail9');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }

        $j=$data->Input('eq10');
        if($j!=null)
        {
            $logo = $data->file('eqpho10');
            $upload = 'upload/repair';
            $filename = $logo->getClientOriginalName();
            $success = $logo->move($upload, $filename);

            $ep = $data->Input('eq10');
            $epdetail = $data->Input('eqdetail10');

            if($success)
            {
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

                $equipmentdetail->save();
            }
        }                        
        return Redirect::to('home');
    }





}
