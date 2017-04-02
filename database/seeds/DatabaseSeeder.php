<?php

use Illuminate\Database\Seeder;
use App\User;
use App\NameEquipment;
use App\Name_equipment_stock;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call('UserTableSeeder');
        $this->call('NameEquipmentTableSeeder');
        $this->call('NameEquipmentStockTableSeeder');
    }
}


class UserTableSeeder  extends Seeder {
    public function run() {
        DB::table('users')->delete();

        $users = array(
            array( 
            	"name" => 'Administrator',
                "name_student" => 'Admin',
                "email" => 'Example@examplemail.com',
                "password" => Hash::make('adminadmin'),
                "level" => '1'
            )
        );

        DB::table('users')->insert($users);

    }
}


// name equipment for student repair
class NameEquipmentTableSeeder  extends Seeder {
    public function run() {
        DB::table('name_equipments')->delete();

        $name_equipments = array(
            array( 
            	"name" => 'เตียงนอน',
                "type_room" => 'ห้องนอน'    
            ),
            array( 
            	"name" => 'เบาะรองนอน',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'ตู้เย็น',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'โต๊ะอ่านหนังสือ',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'เก้าอี้',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'โคมไฟอ่านหนังสือ',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'โคมไฟหัวเตียง',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'โคมไฟกลางห้อง',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'เครื่องปรับอากาศ + รีโมท',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'ตู้กั้นระหว่างเตียง ( เฉพาะหอ 3 )',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'กุญแจห้องพัก + ป้ายห้อง',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'โทรศัพท์',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'ประตูหน้าห้อง',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'ประตูมุ้งลวด',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'จุดเชื่อม internet',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'จุดเชื่อมต่อสัญญาณโทรทัศน์',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'จุดเชื่อมต่อไฟฟ้า',
                "type_room" => 'ห้องนอน'
            ),
            array( 
            	"name" => 'หัวฉัด + สาย',
                "type_room" => 'ห้องน้ำ'
            ),
            array( 
            	"name" => 'ฝักบัว + สาย',
                "type_room" => 'ห้องน้ำ'
            ),
            array( 
            	"name" => 'เครื่องทำน้ำอุ่น',
                "type_room" => 'ห้องน้ำ'
            ),
            array( 
            	"name" => 'ชักโครก',
                "type_room" => 'ห้องน้ำ'
            ),
            array( 
            	"name" => 'กระจก',
                "type_room" => 'ห้องน้ำ'
            ),
            array( 
            	"name" => 'อ่างล้างหน้า',
                "type_room" => 'ห้องน้ำ'
            ),
            array( 
            	"name" => 'โคมไฟห้องน้ำ',
                "type_room" => 'ห้องน้ำ'
            ),
            array( 
            	"name" => 'ประตูหลังห้อง',
                "type_room" => 'ระเบียง'
            )
        );

        DB::table('name_equipments')->insert($name_equipments);

    }
}

// name equipmant stock
class NameEquipmentStockTableSeeder  extends Seeder {
    public function run() {
        DB::table('name_equipment_stocks')->delete();

        $name_equipment_stocks = array(
            array( 
            	"name" => 'หลอดนีออน 18 W.'
            ),
            array( 
            	"name" => 'หลอดนีออน 32 W.'
            ),
            array( 
            	"name" => 'หลอดนีออน 36 W.'
            ),
            array( 
            	"name" => 'หลอดประหยัด(LED)'
            ),
            array( 
            	"name" => 'หลอดใส้ 25W.'
            ),
            array( 
            	"name" => 'หัวฉีดชำระ'
            ),
            array( 
            	"name" => 'ฝักบัว'
            ),
            array( 
            	"name" => 'ก๊อกอ่าง'
            ),
            array( 
            	"name" => 'ก๊อกวาล์วฝักบัว'
            ),
            array( 
            	"name" => 'ก๊อกซักล้าง'
            ),
            array( 
            	"name" => 'มอเตอร์แกนเดี่ยว(MACO)'
            ),
            array( 
            	"name" => 'แค็ปรัน  30ไมโคร'
            ),
            array( 
            	"name" => 'ลูกบิดประตูหน้าห้อง'
            ),
            array( 
            	"name" => 'ลูกบิดประตูห้องน้ำ'
            ),
            array( 
            	"name" => 'รีโมทแอร์'
            ),
            array( 
            	"name" => 'สตาร์ทเตอร์'
            ),
            array( 
            	"name" => 'สายอ่อนน้ำดี'
            )
        );

        DB::table('name_equipment_stocks')->insert($name_equipment_stocks);

    }
}