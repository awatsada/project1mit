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

use App\User;

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
       ->with('num_change_and_repair',$num_change_and_repair);
       

    }

    public function getmember()
    {
       $user = User::where('level',0)->get();

       return view('project/page/member')->with('user',$user);

    }

    public function postmember($id)
    {
       //dd($id);
        $user = User::find($id);
        $user->level = 2;
        $user->save();
        return Redirect::to('member');

    }



    public function stat()
    {
        $ym = date("Y-m");
        if (Change_equipment::all()) {
            # code...

        // dd($ym);
            $count_change = DB::table('change_equipmentdetails')
            ->leftJoin('name_equipments','change_equipmentdetails.equiment','=','name_equipments.name')
            ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))
            ->where('change_equipmentdetails.created_at','LIKE',$ym.'%')
            ->groupBy('change_equipmentdetails.equiment')
            ->get();

         

            $count_repair = DB::table('repair_equipmentdetails')
            ->leftJoin('name_equipments','repair_equipmentdetails.equiment','=','name_equipments.name')
            ->select('repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('repair_equipmentdetails.created_at','LIKE',$ym.'%')
            ->groupBy('repair_equipmentdetails.equiment')
            ->get();
// dd($count_repair);
            $count_unrepair = DB::table('unrepair_equipmentdetails')
            ->leftJoin('name_equipments','unrepair_equipmentdetails.equiment','=','name_equipments.name')
            ->select('unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('unrepair_equipmentdetails.created_at','LIKE',$ym.'%')
            ->groupBy('unrepair_equipmentdetails.equiment')
            ->get();
            $month = date("Y-m");

            if ($count_change) {



                return view('project/page/stat')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair)->with('month',$month);

            }
            else
            {
                return view('project/page/not_stat')->with('month',$month);
            }


        }
        else{
           return view('project/page/not_stat')->with('month',$month);
       }       
   }

    public function statt()
    {
       // dd(input::get('month'));
     $month = input::get('month');
     $pdf = input::get('pdf');
     $check_pdf = "on";

     if ($pdf == $check_pdf) {
        $count_change = DB::table('change_equipmentdetails')
        ->leftJoin('name_equipments','change_equipmentdetails.equiment','=','name_equipments.name')
        ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))->where('change_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('change_equipmentdetails.equiment')
        ->get();
        
        // dd($count_change);

        $count_repair = DB::table('repair_equipmentdetails')
        ->leftJoin('name_equipments','repair_equipmentdetails.equiment','=','name_equipments.name')
        ->select('repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('repair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('repair_equipmentdetails.equiment')
        ->get();

        $count_unrepair = DB::table('unrepair_equipmentdetails')
        ->leftJoin('name_equipments','unrepair_equipmentdetails.equiment','=','name_equipments.name')
        ->select('unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('unrepair_equipmentdetails.created_at','LIKE',$month.'%')
        ->groupBy('unrepair_equipmentdetails.equiment')
        ->get();


        // return view('project/page/statpdf')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair);
        if ($count_change||$count_unrepair||$count_unrepair) {
            $pdf = PDF::loadView('project/page/statpdf',compact('count_change','count_repair','count_unrepair','month'));
            return $pdf->stream('equipment.pdf');
        }
        else
        {
           return view('project/page/not_stat')->with('month',$month);
       }

   } else {
    $count_change = DB::table('change_equipmentdetails')
    ->leftJoin('name_equipments','change_equipmentdetails.equiment','=','name_equipments.name')
    ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))->where('change_equipmentdetails.created_at','LIKE',$month.'%')
    ->groupBy('change_equipmentdetails.equiment')
    ->get();

        dd($count_change);

    $count_repair = DB::table('repair_equipmentdetails')
    ->leftJoin('name_equipments','repair_equipmentdetails.equiment','=','name_equipments.name')
    ->select('repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('repair_equipmentdetails.created_at','LIKE',$month.'%')
    ->groupBy('repair_equipmentdetails.equiment')
    ->get();

    $count_unrepair = DB::table('unrepair_equipmentdetails')
    ->leftJoin('name_equipments','unrepair_equipmentdetails.equiment','=','name_equipments.name')
    ->select('unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('unrepair_equipmentdetails.created_at','LIKE',$month.'%')
    ->groupBy('unrepair_equipmentdetails.equiment')
    ->get();

    if ($count_change) {

        return view('project/page/stat')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair)->with('month',$month);
    }
    else
    {
       return view('project/page/not_stat')->with('month',$month);
   }
}



       

        
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

       if ($count_change) {
        return view('project/page/statprint')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair);
       }
        else
        {
         return view('project/page/not_stat')->with('month',$month);
        }
    
    }



    // public function statpdf()
    // {
    //     $month = input::get('month');
       


    //     $count_change = DB::table('change_equipmentdetails')
    //     ->leftJoin('name_equipments','change_equipmentdetails.id','=','name_equipments.id')
    //     ->select('change_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_c'))->where('change_equipmentdetails.created_at','LIKE',$month.'%')
    //     ->groupBy('change_equipmentdetails.equiment')
    //     ->get();
        
    //     // dd($count_change);
       
    //    $count_repair = DB::table('Repair_equipmentdetails')
    //     ->leftJoin('name_equipments','Repair_equipmentdetails.id','=','name_equipments.id')
    //     ->select('Repair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_r'))->where('Repair_equipmentdetails.created_at','LIKE',$month.'%')
    //     ->groupBy('Repair_equipmentdetails.equiment')
    //     ->get();

    //    $count_unrepair = DB::table('Unrepair_equipmentdetails')
    //     ->leftJoin('name_equipments','Unrepair_equipmentdetails.id','=','name_equipments.id')
    //     ->select('Unrepair_equipmentdetails.equiment',DB::raw('count(name_equipments.name) AS count_u'))->where('Unrepair_equipmentdetails.created_at','LIKE',$month.'%')
    //     ->groupBy('Unrepair_equipmentdetails.equiment')
    //     ->get();


    //     // return view('project/page/statpdf')->with('count_change',$count_change)->with('count_repair',$count_repair)->with('count_unrepair',$count_unrepair);

    //     $pdf = PDF::loadView('project/page/statpdf',compact('count_change','count_repair','count_unrepair'));
    //     return $pdf->stream('equipment.pdf');
    
    // }



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
        $level = Auth::user()->level;
        

        return view('project/page/fix')->with('name_equipment',$name_equipment)->with('list_fix',$list_fix)->with('level',$level);
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
       $name_equipment = Name_equipment_stock::all(); 
       // echo $Equu;     
       return view('project/page/edit_unrepair')->with('Equ',$Equ)->with('Equu',$Equu)->with('name_equipment',$name_equipment);

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
       

                if (input::get('status'.$key)=="unrepair") 
                {

                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    if (input::get('list_use_equipment'.$key)) {
                        $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                        $v->number = input::get('num'.$key);
                    }

                    $v->save();
    
                     
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
       $name_equipment = Name_equipment_stock::all(); 
       
       return view('project/page/edit_change_and_repair')->with('name_equipment',$name_equipment)->with('Eqc',$Eqc)->with('Eqr',$Eqr)->with('Eqcc',$Eqcc)->with('Eqrr',$Eqrr);

    }

    public function delete_record_complete($id)
    {    
       $Eqr = repair_equipmentdetail::where('id_repairequipment',$id)->delete();
       $Eqrr = repair_equipment::where('id',$id)->delete(); 

       $Eqc = repair_equipmentdetail::where('id_repairequipment',$id)->delete();
       $Eqcc = repair_equipment::where('id',$id)->delete(); 
            
       return Redirect::to('showw');

    }

    public function update_record_complete($id)
    {
       $Ec = Change_equipmentdetail::where('id_changeequipment',$id)->get();
       $Er = Repair_equipmentdetail::where('id_repairequipment',$id)->get();

       if ($Ec) //status change
       {
            foreach ($Ec as $key => $v) 
            {
                if (input::get('status'.$key)=="change") 
                {
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    if (input::get('list_use_equipment'.$key)) {
                        $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                        $v->number = input::get('num'.$key);
                      
                        }
                   
                        $v->save();
            }   
       } }
       else //status repair
       {
            foreach ($Er as $key => $v) 
            {
                

                if (input::get('status'.$key)=="repair") 
                {
                    
                    $v->detail_repair = input::get('list_detail_repair'.$key);
                    if (input::get('list_use_equipment'.$key)) {
                        $v->detail_use_equipment = input::get('list_use_equipment'.$key);
                        $v->number = input::get('num'.$key);
                        
                        }
                    
                 
                    $v->save();
 
                    
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
       $level = Auth::user()->level;

       // $count = Equipmentdetail::where('id_equipment',$id)->count();
       return view('project/page/editfix')->with('Eq',$Eq)->with('Eqd',$Eqd)->with('level',$level);
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
            // $k=$data->Input('eq'.$key);
                if($data->Input('eq'.$key))
                {
                    $logo = $data->file('eqpho'.$key);
                  

                    if($logo)
                    {
                        $upload = 'upload/repair';
                        $filename = $logo->getClientOriginalName();
                        $success = $logo->move($upload, $filename);

                        $ep = $data->Input('eq'.$key);
                        $epdetail = $data->Input('eqdetail'.$key);
                        $v->photo_repair = $filename;
                        // $v->id_equipment = $equipment->id;
                        $v->equipment = $ep;
                        $v->detail_equipment = $epdetail;

                        
                    }
                    else
                    {
                        $ep = $data->Input('eq'.$key);
                        $epdetail = $data->Input('eqdetail'.$key);
                        // $v->photo_repair = $filename;
                        // $v->id_equipment = $equipment->id;
                        $v->equipment = $ep;
                        $v->detail_equipment = $epdetail;
                    }
                    $v->save();
                }

            
        }


        return Redirect::to('fix');   
    }



    public function editEq_fix($id)
    {  
        $Eqd = Equipmentdetail::where('id',$id)->first();  
        return view('project/page/editfixequipment')->with('Eqd',$Eqd);
    }

    public function updateEq_fix(Request $data, $id)
    {  
         
$i = 0;
if ($data->Input('eq'.$i)) 
        {
            $logo = $data->file('eqpho'.$i);

            if($logo)
            {
                $upload = 'upload/repair';
                $filename = $logo->getClientOriginalName();
                $success = $logo->move($upload, $filename);

                $ep = $data->Input('eq'.$i);
                $epdetail = $data->Input('eqdetail'.$i);

            
                $equipmentdetail = Equipmentdetail::where('id',$id)->first(); 
                $equipmentdetail->photo_repair = $filename;
                // $equipmentdetail->id_equipment = $equipment->id_equipment;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

            }
            else
            {
                $ep = $data->Input('eq'.$i);
                $epdetail = $data->Input('eqdetail'.$i);

                $equipmentdetail = Equipmentdetail::where('id',$id)->first(); 
                // $equipmentdetail->id_equipment = $equipment->id_equipment;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

            }    
            $equipmentdetail->save();
     
            $i++;
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

        $i = 0;
        while ($data->Input('eq'.$i)) 
        {
            $logo = $data->file('eqpho'.$i);

            if($logo)
            {
                $upload = 'upload/repair';
                $filename = $logo->getClientOriginalName();
                $success = $logo->move($upload, $filename);

                $ep = $data->Input('eq'.$i);
                $epdetail = $data->Input('eqdetail'.$i);

            
                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->photo_repair = $filename;
                $equipmentdetail->id_equipment = $equipment->id_equipment;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

            }
            else
            {
                $ep = $data->Input('eq'.$i);
                $epdetail = $data->Input('eqdetail'.$i);

                $equipmentdetail = new Equipmentdetail;
                $equipmentdetail->id_equipment = $equipment->id_equipment;
                $equipmentdetail->equipment = $ep;
                $equipmentdetail->detail_equipment = $epdetail;

            }    
            $equipmentdetail->save();
     
            $i++;
        }
               
        return Redirect::to('home');
    }





}
