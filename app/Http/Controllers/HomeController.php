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
        $equipment = Equipment::all();
   
        $unrepair_equipment = Unrepair_equipment::all();

    
        $num_change = DB::table('change_equipments');
        $num_change_and_repair = DB::table('repair_equipments')->union($num_change)->get();


       return view('project/page/show')->with('equipment',$equipment)
       ->with('unrepair_equipment',$unrepair_equipment) 
       ->with('num_change_and_repair',$num_change_and_repair)
       ;
        // $equipment = Equipment::all();
        // return view('project/page/show')->with('equipment',$equipment);
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
        $name_equipment = Name_equipment_stock::all(); 
        return view('project/page/record')->with('Eq',$Eq)->with('Eqd',$Eqd)->with('count',$count)->with('name_equipment',$name_equipment);
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

    public function edit_record_uncomplete($id)
    {    
       $Equ = Unrepair_equipmentdetail::where('id_unrepairequipment',$id)->get();
       $Equu = Unrepair_equipment::where('id',$id)->first(); 
       // echo $Equu;     
       return view('project/page/edit_unrepair')->with('Equ',$Equ)->with('Equu',$Equu);

    }

    public function delete_record_uncomplete($id)
    {    
       $Equ = Unrepair_equipmentdetail::where('id_unrepairequipment',$id)->delete();
       $Equu = Unrepair_equipment::where('id',$id)->delete(); 
            
       return Redirect::to('showw');

    }

    public function update_record_uncomplete($id)
    {    
       $Equ = Unrepair_equipmentdetail::where('id_unrepairequipment',$id)->get();
       // $Equu = Unrepair_equipment::where('id',$id)->first(); 
       foreach ($Equ as $key => $v) 
            {
                if (input::get('status'.$key)=="change") 
                {
                    //$Change_equipment->id_user = $Eq->id_user;
                    //$Change_equipment->phone_number = $Eq->phone_number;
                    //$Change_equipment->num_room = $Eq->num_room;
                    //$Change_equipment->date_in = $Eq->date_in;
                    //$Change_equipment->date_repair = $Eq->date_repair;
                    //$Change_equipment->time_repair = $Eq->time_repair;
                    //$Change_equipment->live = $Eq->live;
                    //$Change_equipment->note = $Eq->note;
                    //$Change_equipment->save();

                    //$Change_equipmentdetail->id_changeequipment = $Change_equipment->id; 
                    //$Change_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    //$Change_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    //$Change_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    //$Change_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    //$Change_equipmentdetail->date_finish_repair = date("Y-m-d");
                    //$Change_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    //$Change_equipmentdetail->name_technical = Auth::user()->name;
                    //$Change_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////

 


                }

                if (input::get('status'.$key)=="repair") 
                {
                    // $Repair_equipment->id_user = $Eq->id_user;
                    // $Repair_equipment->phone_number = $Eq->phone_number;
                    // $Repair_equipment->num_room = $Eq->num_room;
                    // $Repair_equipment->date_in = $Eq->date_in;
                    // $Repair_equipment->date_repair = $Eq->date_repair;
                    // $Repair_equipment->time_repair = $Eq->time_repair;
                    // $Repair_equipment->live = $Eq->live;
                    // $Repair_equipment->note = $Eq->note;
                    // $Repair_equipment->save();

                    // $Repair_equipmentdetail->id_repairequipment = $Repair_equipment->id; 
                    // $Repair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    // $Repair_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    // $Repair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    // $Repair_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    // $Repair_equipmentdetail->date_finish_repair = date("Y-m-d");
                    // $Repair_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    // $Repair_equipmentdetail->name_technical = Auth::user()->name;
                    // $Repair_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    // $a = input::get('list_use_equipment'.$key);
                    // $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    // $in = $equipment->number;

                    // $nb = input::get('num'.$key); 

                    // $sum = ($in-$nb);

                    // $equipment->number = $sum;
                    // $equipment->save();
                }        

                if (input::get('status'.$key)=="unrepair") 
                {
                    // $Unrepair_equipment->id_user = $Eq->id_user;
                    // $Unrepair_equipment->phone_number = $Eq->phone_number;
                    // $Unrepair_equipment->num_room = $Eq->num_room;
                    // $Unrepair_equipment->date_in = $Eq->date_in;
                    // $Unrepair_equipment->date_repair = $Eq->date_repair;
                    // $Unrepair_equipment->time_repair = $Eq->time_repair;
                    // $Unrepair_equipment->live = $Eq->live;
                    // $Unrepair_equipment->note = $Eq->note;
                    // $Unrepair_equipment->save();

                    // $Unrepair_equipmentdetail->id_unrepairequipment = $Unrepair_equipment->id; 
                    // $Unrepair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    // $Unrepair_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    // $Unrepair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    // $Unrepair_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    // $Unrepair_equipmentdetail->date_finish_repair = date("Y-m-d");
                    // $Unrepair_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    // $Unrepair_equipmentdetail->name_technical = Auth::user()->name;
                    // $Unrepair_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    // $a = input::get('list_use_equipment'.$key);
                    // $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    // $in = $equipment->number;

                    // $nb = input::get('num'.$key); 

                    // $sum = ($in-$nb);

                    // $equipment->number = $sum;
                    // $equipment->save();             
                }
           
            }        
       return Redirect::to('showw');

    }


///***********************************//////***********************************///

///***********************************//////***********************************///


    public function edit_record_complete($id)
    {    
       $Eqc = Change_equipmentdetail::where('id_changeequipment',$id)->get();
       $Eqcc = Change_equipment::where('id',$id)->first(); 
       $Eqr = Repair_equipmentdetail::where('id_repairequipment',$id)->get(); 
       $Eqrr = Repair_equipment::where('id',$id)->first();
       
       
       return view('project/page/edit_change_and_repair')->with('Eqc',$Eqc)->with('Eqr',$Eqr)->with('Eqcc',$Eqcc)->with('Eqrr',$Eqrr);

    }

    public function update_record_complete($id)
    {
       $Ec = Change_equipmentdetail::where('id_changeequipment',$id)->get();
       $Er = Repair_equipmentdetail::where('id_repairequipment',$id)->get();

       if ($Ec) //set 1
       {
            foreach ($Ec as $key => $v) 
            {
                if (input::get('status'.$key)=="change") 
                {
                    //$Change_equipment->id_user = $Eq->id_user;
                    //$Change_equipment->phone_number = $Eq->phone_number;
                    //$Change_equipment->num_room = $Eq->num_room;
                    //$Change_equipment->date_in = $Eq->date_in;
                    //$Change_equipment->date_repair = $Eq->date_repair;
                    //$Change_equipment->time_repair = $Eq->time_repair;
                    //$Change_equipment->live = $Eq->live;
                    //$Change_equipment->note = $Eq->note;
                    //$Change_equipment->save();

                    //$Change_equipmentdetail->id_changeequipment = $Change_equipment->id; 
                    //$Change_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    //$Change_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    //$Change_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    //$Change_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    //$Change_equipmentdetail->date_finish_repair = date("Y-m-d");
                    //$Change_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    //$Change_equipmentdetail->name_technical = Auth::user()->name;
                    //$Change_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    $a = input::get('list_use_equipment'.$key);
                    $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    $in = $equipment->number;

                    $nb = input::get('num'.$key); 

                    $sum = ($in-$nb);

                    $equipment->number = $sum;
                    $equipment->save();



                }

                if (input::get('status'.$key)=="repair") 
                {
                    // $Repair_equipment->id_user = $Eq->id_user;
                    // $Repair_equipment->phone_number = $Eq->phone_number;
                    // $Repair_equipment->num_room = $Eq->num_room;
                    // $Repair_equipment->date_in = $Eq->date_in;
                    // $Repair_equipment->date_repair = $Eq->date_repair;
                    // $Repair_equipment->time_repair = $Eq->time_repair;
                    // $Repair_equipment->live = $Eq->live;
                    // $Repair_equipment->note = $Eq->note;
                    // $Repair_equipment->save();

                    // $Repair_equipmentdetail->id_repairequipment = $Repair_equipment->id; 
                    // $Repair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    // $Repair_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    // $Repair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    // $Repair_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    // $Repair_equipmentdetail->date_finish_repair = date("Y-m-d");
                    // $Repair_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    // $Repair_equipmentdetail->name_technical = Auth::user()->name;
                    // $Repair_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    $a = input::get('list_use_equipment'.$key);
                    $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    $in = $equipment->number;

                    $nb = input::get('num'.$key); 

                    $sum = ($in-$nb);

                    $equipment->number = $sum;
                    $equipment->save();
                }        

                if (input::get('status'.$key)=="unrepair") 
                {
                    // $Unrepair_equipment->id_user = $Eq->id_user;
                    // $Unrepair_equipment->phone_number = $Eq->phone_number;
                    // $Unrepair_equipment->num_room = $Eq->num_room;
                    // $Unrepair_equipment->date_in = $Eq->date_in;
                    // $Unrepair_equipment->date_repair = $Eq->date_repair;
                    // $Unrepair_equipment->time_repair = $Eq->time_repair;
                    // $Unrepair_equipment->live = $Eq->live;
                    // $Unrepair_equipment->note = $Eq->note;
                    // $Unrepair_equipment->save();

                    // $Unrepair_equipmentdetail->id_unrepairequipment = $Unrepair_equipment->id; 
                    // $Unrepair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    // $Unrepair_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    // $Unrepair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    // $Unrepair_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    // $Unrepair_equipmentdetail->date_finish_repair = date("Y-m-d");
                    // $Unrepair_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    // $Unrepair_equipmentdetail->name_technical = Auth::user()->name;
                    // $Unrepair_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    $a = input::get('list_use_equipment'.$key);
                    $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    $in = $equipment->number;

                    $nb = input::get('num'.$key); 

                    $sum = ($in-$nb);

                    $equipment->number = $sum;
                    $equipment->save();             
                }
           
            }   
       } 
       else //set 2
       {
            foreach ($Er as $key => $v) 
            {
                if (input::get('status'.$key)=="change") 
                {
                    //$Change_equipment->id_user = $Eq->id_user;
                    //$Change_equipment->phone_number = $Eq->phone_number;
                    //$Change_equipment->num_room = $Eq->num_room;
                    //$Change_equipment->date_in = $Eq->date_in;
                    //$Change_equipment->date_repair = $Eq->date_repair;
                    //$Change_equipment->time_repair = $Eq->time_repair;
                    //$Change_equipment->live = $Eq->live;
                    //$Change_equipment->note = $Eq->note;
                    //$Change_equipment->save();

                    //$Change_equipmentdetail->id_changeequipment = $Change_equipment->id; 
                    //$Change_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    //$Change_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    //$Change_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    // $Change_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    // $Change_equipmentdetail->date_finish_repair = date("Y-m-d");
                    // $Change_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    // $Change_equipmentdetail->name_technical = Auth::user()->name;
                    // $Change_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    $a = input::get('list_use_equipment'.$key);
                    $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    $in = $equipment->number;

                    $nb = input::get('num'.$key); 

                    $sum = ($in-$nb);

                    $equipment->number = $sum;
                    $equipment->save();



                }

                if (input::get('status'.$key)=="repair") 
                {
                    // $Repair_equipment->id_user = $Eq->id_user;
                    // $Repair_equipment->phone_number = $Eq->phone_number;
                    // $Repair_equipment->num_room = $Eq->num_room;
                    // $Repair_equipment->date_in = $Eq->date_in;
                    // $Repair_equipment->date_repair = $Eq->date_repair;
                    // $Repair_equipment->time_repair = $Eq->time_repair;
                    // $Repair_equipment->live = $Eq->live;
                    // $Repair_equipment->note = $Eq->note;
                    // $Repair_equipment->save();

                    // $Repair_equipmentdetail->id_repairequipment = $Repair_equipment->id; 
                    // $Repair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    // $Repair_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    // $Repair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    // $Repair_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    // $Repair_equipmentdetail->date_finish_repair = date("Y-m-d");
                    // $Repair_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    // $Repair_equipmentdetail->name_technical = Auth::user()->name;
                    // $Repair_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    $a = input::get('list_use_equipment'.$key);
                    $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    $in = $equipment->number;

                    $nb = input::get('num'.$key); 

                    $sum = ($in-$nb);

                    $equipment->number = $sum;
                    $equipment->save();
                }        

                if (input::get('status'.$key)=="unrepair") 
                {
                    // $Unrepair_equipment->id_user = $Eq->id_user;
                    // $Unrepair_equipment->phone_number = $Eq->phone_number;
                    // $Unrepair_equipment->num_room = $Eq->num_room;
                    // $Unrepair_equipment->date_in = $Eq->date_in;
                    // $Unrepair_equipment->date_repair = $Eq->date_repair;
                    // $Unrepair_equipment->time_repair = $Eq->time_repair;
                    // $Unrepair_equipment->live = $Eq->live;
                    // $Unrepair_equipment->note = $Eq->note;
                    // $Unrepair_equipment->save();

                    // $Unrepair_equipmentdetail->id_unrepairequipment = $Unrepair_equipment->id; 
                    // $Unrepair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
                    // $Unrepair_equipmentdetail->equiment = $Eqd[$i]->equipment;
                    // $Unrepair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

                    // $Unrepair_equipmentdetail->id_usersaverepair = Auth::user()->id;
                    // $Unrepair_equipmentdetail->date_finish_repair = date("Y-m-d");
                    // $Unrepair_equipmentdetail->date_depart_equipment = date("Y-m-d");
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                    $v->number = input::get('num'.$key);
                    // $Unrepair_equipmentdetail->name_technical = Auth::user()->name;
                    // $Unrepair_equipmentdetail->name_technical_depart = Auth::user()->name;
                    $v->save();
    ///////////*************************************************************////////////
                    $a = input::get('list_use_equipment'.$key);
                    $equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
                    $in = $equipment->number;

                    $nb = input::get('num'.$key); 

                    $sum = ($in-$nb);

                    $equipment->number = $sum;
                    $equipment->save();             
                }
           
            } 
       }
       

       return Redirect::to('showw');
    }




///***********************************//////***********************************///

///***********************************//////***********************************///
    public function edit_fix($id)
    {    
       $Eq = Equipment::where('id_equipment',$id)->first();  
       $Eqd = Equipmentdetail::where('id_equipment',$id)->get();
       // $count = Equipmentdetail::where('id_equipment',$id)->count();
       return view('project/page/editfix')->with('Eq',$Eq)->with('Eqd',$Eqd);
    }
    public function update_fix(Request $data, $id)
    {   
       // echo $id;
        $equipment = Equipment::where('id_equipment',$id)->first();
        $Eqd = Equipmentdetail::where('id_equipment',$id)->get();   
        // echo $equipment;   
        //$equipment->id_user = Auth::user()->id;   
        $equipment->phone_number = input::get('phone_number');  
        $equipment->num_room = input::get('num_room');
        // $date = date("Y-m-d"); 
        $equipment->date_in = date("Y-m-d");   
        $equipment->date_repair = input::get('date_repair');    
        $equipment->time_repair = input::get('time_repair');    
        $equipment->live = input::get('live');
        $equipment->note = input::get('note');
        $equipment->save();

        foreach ($Eqd as $key => $v) 
        {
            $k=$data->Input('eq'.$key);
                if($k!=null)
                {
                    $logo = $data->file('eqpho'.$key);
                    $upload = 'upload/repair';
                    $filename = $logo->getClientOriginalName();
                    $success = $logo->move($upload, $filename);

                    $ep = $data->Input('eq'.$key);
                    $epdetail = $data->Input('eqdetail'.$key);

                if($success)
                {
                    
                    $v->photo_repair = $filename;
                    // $v->id_equipment = $equipment->id;
                    $v->equipment = $ep;
                    $v->detail_equipment = $epdetail;

                    $v->save();
                }
        }

            
        }






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
