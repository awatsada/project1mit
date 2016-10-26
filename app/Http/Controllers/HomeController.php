<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\NameEquipment;
use App\Equipment;
use App\Equipmentdetail;
use App\Change;
use App\repair;
use App\unrepair;
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
        return view('project/index')->with('equipment',$equipment);
    }




    public function show()
    {
        $equipment = Equipment::all();
        return view('project/page/showrepair')->with('equipment',$equipment);
    }

    public function showequipment($id)
    {
        $user = Equipment::where('id_equipment',$id)->first();
        $user1 = Equipmentdetail::where('id_equipment',$id)->get();
        
        return view('project/page/showequipment')->with('user',$user)->with('user1',$user1);
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




    public function fix()
    {
        $name_equipment = NameEquipment::all();     
        return view('project/page/fix')->with('name_equipment',$name_equipment);
    }


    // public function record()
    // {   
   
    //     return view('project/page/record');
    // }


    public function record($id)
    {   
        $user1 = Equipmentdetail::where('id',$id)->first();
        return view('project/page/record')->with('user1',$user1);
    }


    // public function saverecord($id)
    // {   
    //     $recordequipment = new Recordequipment;
    //     $equipment = Equipment::all();
    //     $user1 = Equipmentdetail::where('id',$id)->first();
    //     // dd($user1);
    //     // echo $user1;
    //     $a=$user1->id;
    //     // echo $a;
    //     $b=Equipment::where('id_equipment',$a)->first();
    //     // echo $b;
    //     $c=($b->id_user);
    //     // echo $c;
    //     // dd('stop');

    //     $recordequipment->id_user = $c;
    //     $recordequipment->id_equipmentdetail = $id;
    //     $recordequipment->date_finish_repair = date("Y-m-d");
    //     $recordequipment->date_depart_equipment = date("Y-m-d");
    //     $recordequipment->detail_repair = input::get('list_detail_repair');
    //     $recordequipment->detail_use_equipment = input::get('list_use_equipment');
    //     $recordequipment->name_technical = Auth::user()->name;
    //     $recordequipment->name_technical_depart = Auth::user()->name;
    //     $recordequipment->status = input::get('status');
    //     $recordequipment->save();

    //     return view('project/index')->with('equipment',$equipment);
    // }

    public function saverecord($id)
    {   
        $change = new Change;
        $repair = new Repair;
        $unrepair = new Unrepair;
        $equipment = Equipment::all();
        $user1 = Equipmentdetail::where('id',$id)->first();
        // dd($user1);
        // echo $user1;
        $a=$user1->id;
        // echo $a;
        $b=Equipment::where('id_equipment',$a)->first();
        // echo $b;
        $c=($b->id_user);
        // echo $c;
        // dd('stop');

        if (input::get('status')=="change") 
        {
        $change->id_user = $c;
        $change->id_equipmentdetail = $id;
        $change->date_finish_repair = date("Y-m-d");
        $change->date_depart_equipment = date("Y-m-d");
        $change->detail_repair = input::get('list_detail_repair');
        $change->detail_use_equipment = input::get('list_use_equipment');
        $change->name_technical = Auth::user()->name;
        $change->name_technical_depart = Auth::user()->name;
        $change->save();
        }

        if (input::get('status')=="repair") 
        {
        $repair->id_user = $c;
        $repair->id_equipmentdetail = $id;
        $repair->date_finish_repair = date("Y-m-d");
        $repair->date_depart_equipment = date("Y-m-d");
        $repair->detail_repair = input::get('list_detail_repair');
        $repair->detail_use_equipment = input::get('list_use_equipment');
        $repair->name_technical = Auth::user()->name;
        $repair->name_technical_depart = Auth::user()->name;
        $repair->save();
        }        

        if (input::get('status')=="unrepair") 
        {
        $unrepair->id_user = $c;
        $unrepair->id_equipmentdetail = $id;
        $unrepair->date_finish_repair = date("Y-m-d");
        $unrepair->date_depart_equipment = date("Y-m-d");
        $unrepair->detail_repair = input::get('list_detail_repair');
        $unrepair->detail_use_equipment = input::get('list_use_equipment');
        $unrepair->name_technical = Auth::user()->name;
        $unrepair->name_technical_depart = Auth::user()->name;
        $unrepair->save();
        }

        return view('project/index')->with('equipment',$equipment);
    }



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
