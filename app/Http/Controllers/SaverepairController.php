<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Auth;
use PDF;
use DB;

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

class SaverepairController extends Controller
{
	public function saverecord($id)
	{   
    	// $id is id equipment
		$Change_equipment = new Change_equipment;
		$Change_equipmentdetail = new Change_equipmentdetail;
		$Repair_equipment = new Repair_equipment;
		$Repair_equipmentdetail = new Repair_equipmentdetail;
		$Unrepair_equipment = new Unrepair_equipment;
		$Unrepair_equipmentdetail = new Unrepair_equipmentdetail;

		
		$equipment = Equipment::all();
        $unrepair_equipment = Unrepair_equipment::all();
        $num_change = DB::table('change_equipments');
        $num_change_and_repair = DB::table('repair_equipments')->union($num_change)->get();

        // $Eq is 1 column in table eqipment
		$Eq = Equipment::where('id_equipment',$id)->first();
        // echo $Eq;
        // echo $Eq->id_equipment;
        // dd ('stop');
		$Eqd = Equipmentdetail::where('id_equipment',$id)->get();
		$count = Equipmentdetail::where('id_equipment',$id)->count();


		for ($i=0; $i <$count ; $i++) 
		{ 
            # code...

            // $name = 'status'.$i;


			if (input::get('status'.$i)=="change") 
			{
				$Change_equipment->id_user = $Eq->id_user;
				$Change_equipment->phone_number = $Eq->phone_number;
				$Change_equipment->num_room = $Eq->num_room;
				$Change_equipment->date_in = $Eq->date_in;
				$Change_equipment->date_repair = $Eq->date_repair;
				$Change_equipment->time_repair = $Eq->time_repair;
				$Change_equipment->live = $Eq->live;
				$Change_equipment->note = $Eq->note;
				$Change_equipment->save();

				$Change_equipmentdetail->id_changeequipment = $Change_equipment->id; 
				$Change_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
				$Change_equipmentdetail->equiment = $Eqd[$i]->equipment;
				$Change_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

				$Change_equipmentdetail->id_usersaverepair = Auth::user()->id;
				$Change_equipmentdetail->date_finish_repair = date("Y-m-d");
				$Change_equipmentdetail->date_depart_equipment = date("Y-m-d");
				$Change_equipmentdetail->detail_repair = input::get('list_detail_repair'.$i);
				$Change_equipmentdetail->detail_use_equipment = input::get('list_use_equipment'.$i);
				$Change_equipmentdetail->number = input::get('num'.$i);
				$Change_equipmentdetail->name_technical = Auth::user()->name;
				$Change_equipmentdetail->name_technical_depart = Auth::user()->name;
				$Change_equipmentdetail->save();
///////////*************************************************************////////////
				$a = input::get('list_use_equipment'.$i);
    			$equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
    			$in = $equipment->number;

    			$nb = input::get('num'.$i); 

    			$sum = ($in-$nb);

    			$equipment->number = $sum;
    			$equipment->save();



			}

			if (input::get('status'.$i)=="repair") 
			{
				$Repair_equipment->id_user = $Eq->id_user;
				$Repair_equipment->phone_number = $Eq->phone_number;
				$Repair_equipment->num_room = $Eq->num_room;
				$Repair_equipment->date_in = $Eq->date_in;
				$Repair_equipment->date_repair = $Eq->date_repair;
				$Repair_equipment->time_repair = $Eq->time_repair;
				$Repair_equipment->live = $Eq->live;
				$Repair_equipment->note = $Eq->note;
				$Repair_equipment->save();

				$Repair_equipmentdetail->id_repairequipment = $Repair_equipment->id; 
				$Repair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
				$Repair_equipmentdetail->equiment = $Eqd[$i]->equipment;
				$Repair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

				$Repair_equipmentdetail->id_usersaverepair = Auth::user()->id;
				$Repair_equipmentdetail->date_finish_repair = date("Y-m-d");
				$Repair_equipmentdetail->date_depart_equipment = date("Y-m-d");
				$Repair_equipmentdetail->detail_repair = input::get('list_detail_repair'.$i);
				$Repair_equipmentdetail->detail_use_equipment = input::get('list_use_equipment'.$i);
				$Change_equipmentdetail->number = input::get('num'.$i);
				$Repair_equipmentdetail->name_technical = Auth::user()->name;
				$Repair_equipmentdetail->name_technical_depart = Auth::user()->name;
				$Repair_equipmentdetail->save();
///////////*************************************************************////////////
				$a = input::get('list_use_equipment'.$i);
    			$equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
    			$in = $equipment->number;

    			$nb = input::get('num'.$i); 

    			$sum = ($in-$nb);

    			$equipment->number = $sum;
    			$equipment->save();
			}        

			if (input::get('status'.$i)=="unrepair") 
			{
				$Unrepair_equipment->id_user = $Eq->id_user;
				$Unrepair_equipment->phone_number = $Eq->phone_number;
				$Unrepair_equipment->num_room = $Eq->num_room;
				$Unrepair_equipment->date_in = $Eq->date_in;
				$Unrepair_equipment->date_repair = $Eq->date_repair;
				$Unrepair_equipment->time_repair = $Eq->time_repair;
				$Unrepair_equipment->live = $Eq->live;
				$Unrepair_equipment->note = $Eq->note;
				$Unrepair_equipment->save();

				$Unrepair_equipmentdetail->id_unrepairequipment = $Unrepair_equipment->id; 
				$Unrepair_equipmentdetail->photo_repair = $Eqd[$i]->photo_repair;
				$Unrepair_equipmentdetail->equiment = $Eqd[$i]->equipment;
				$Unrepair_equipmentdetail->detail_equiment = $Eqd[$i]->detail_equipment;

				$Unrepair_equipmentdetail->id_usersaverepair = Auth::user()->id;
				$Unrepair_equipmentdetail->date_finish_repair = date("Y-m-d");
				$Unrepair_equipmentdetail->date_depart_equipment = date("Y-m-d");
				$Unrepair_equipmentdetail->detail_repair = input::get('list_detail_repair'.$i);
				$Unrepair_equipmentdetail->detail_use_equipment = input::get('list_use_equipment'.$i);
				$Change_equipmentdetail->number = input::get('num'.$i);
				$Unrepair_equipmentdetail->name_technical = Auth::user()->name;
				$Unrepair_equipmentdetail->name_technical_depart = Auth::user()->name;
				$Unrepair_equipmentdetail->save();
///////////*************************************************************////////////
				$a = input::get('list_use_equipment'.$i);
    			$equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
    			$in = $equipment->number;

    			$nb = input::get('num'.$i); 

    			$sum = ($in-$nb);

    			$equipment->number = $sum;
    			$equipment->save();				
			}
                
         
		}
        $delEqd = Equipmentdetail::where('id_equipment',$id)->delete();
		$delEq = Equipment::where('id_equipment',$id)->delete();


//variable from index
        $count_change = Change_equipment::count();
        $count_repair = Repair_equipment::count();
        $count_id = $count_change;
        $i=0;



        
		// return view('project/index')->with('equipment',$equipment)
		//                             ->with('num_change_and_repair',$num_change_and_repair)
  //                                   ->with('unrepair_equipment',$unrepair_equipment);
        return Redirect::to('home');
	}
}
