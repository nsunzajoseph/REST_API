<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categr =[
            array(
            'name'=>'Information Communication Technology',
            'type'=>'Science'
            ),
            array(
                'name'=>'Biology',
                'type'=>'Education in science'
            ),
                array(
                'name'=>'Dental Unit',
                'type'=>'Treatment'
                 )
                                                
        ];
        //then loop all data to seed them into database
        foreach($categr as $data){
            Category::create($data);
        }
        
    }
}
