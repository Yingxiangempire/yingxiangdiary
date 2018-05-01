<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content');//日签内容
            $table->tinyInteger('status')->default(1);//状态值1表示正常，0表示删除
            $table->timestamps();
        });

//        $letters=['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'];
//        foreach ($letters as $letter ){
//            foreach($letters as $char){
//                $this->createTable($char.$letter);
//            }
//        }
    }
    
    private function createTable($postfix){
        Schema::create('content_'.$postfix, function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content');//日签内容
            $table->tinyInteger('status')->default(1);//状态值1表示正常，0表示删除
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}
