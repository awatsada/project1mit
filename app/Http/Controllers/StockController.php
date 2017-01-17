<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Auth;
use PDF;
use DB;
use Fpdf;

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

class StockController extends Controller
{
	public function showstock()
    {
        $equipment = Save_stock::all();
        return view('project/page/show_stock')->with('equipment',$equipment);
    }



    public function showsavestock()
    {
        $name_equipment = Name_equipment_stock::all();     
        return view('project/page/save_stock')->with('name_equipment',$name_equipment);
    }


    public function savestock()
    {
    	$savestock = new Save_stock;

    	$k=input::get('name0');

    	$equipment = Save_stock::all();
    	// $in=$equipment->name;

    	$i = 0;
    	foreach ($equipment as $value) 
    	{
    		// $equipment[$i];

  	    // same name 
    		if ($k==$equipment[$i]->name)
    		{

    			$a=input::get('name0');
    			$equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
    			$in=$equipment->number;

    			$nb = input::get('num0'); 

    			$sum=($in+$nb);

    			$equipment->number = $sum;
    			$equipment->save();
    			//echo "success1";
    			return Redirect::to('home');


    		} 
        // different name	
    		else 
    		{
    			$k=input::get('num0'); 
    			if($k!=null)
    			{
    				$savestock->id_user = Auth::user()->id;
    				$savestock->name = input::get('name0'); 
    				$savestock->number = input::get('num0'); 
    				$savestock->save();
    				//echo "success2";
    				return Redirect::to('home');
    			}
    		}
    		$i++;

    	}



    	//////name1
    	    	$savestock = new Save_stock;

    	$k=input::get('name1');

    	$equipment = Save_stock::all();
    	// $in=$equipment->name;

    	$i = 0;
    	foreach ($equipment as $value) 
    	{
    		// $equipment[$i];

  	    // same name 
    		if ($k==$equipment[$i]->name)
    		{

    			$a=input::get('name1');
    			$equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
    			$in=$equipment->number;

    			$nb = input::get('num1'); 

    			$sum=($in+$nb);

    			$equipment->number = $sum;
    			$equipment->save();
    			// echo "success1";
    			return Redirect::to('home');


    		} 
        // different name	
    		else 
    		{
    			$k=input::get('num1'); 
    			if($k!=null)
    			{
    				$savestock->id_user = Auth::user()->id;
    				$savestock->name = input::get('name1'); 
    				$savestock->number = input::get('num1'); 
    				$savestock->save();
    				// echo "success2";
    				return Redirect::to('home');
    			}
    		}
    		$i++;

    	}


    	//////name2
    	    	$savestock = new Save_stock;

    	$k=input::get('name2');

    	$equipment = Save_stock::all();
    	// $in=$equipment->name;

    	$i = 0;
    	foreach ($equipment as $value) 
    	{
    		// $equipment[$i];

  	    // same name 
    		if ($k==$equipment[$i]->name)
    		{

    			$a=input::get('name2');
    			$equipment = Save_stock::where('name','LIKE','%'.$a.'%')->first();
    			$in=$equipment->number;

    			$nb = input::get('num2'); 

    			$sum=($in+$nb);

    			$equipment->number = $sum;
    			$equipment->save();
    			// echo "success1";
    			return Redirect::to('home');


    		} 
        // different name	
    		else 
    		{
    			$k=input::get('num2'); 
    			if($k!=null)
    			{
    				$savestock->id_user = Auth::user()->id;
    				$savestock->name = input::get('name2'); 
    				$savestock->number = input::get('num2'); 
    				$savestock->save();
    				// echo "success2";
    				return Redirect::to('showstock');
    			}
    		}
    		$i++;

    	}

        
    }
}
