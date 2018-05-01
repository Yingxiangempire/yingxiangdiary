<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{

    protected $table = 'post';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('weather');//天气代号
            $table->string('location', 100);//地点
            $table->smallInteger('tag');//标签
            $table->string('pic', 200);//图片
            $table->string('sub_content', 200);//主要内容
            $table->smallInteger('words');//字数
            $table->integer('content_id')->default(0);//内容表主键值
            $table->tinyInteger('status')->default(1);//状态值1表示正常，0表示删除
            $table->tinyInteger('is_public')->default(0);//是否开放
            $table->timestamps();
        });
//        $letters=['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'];
//        foreach ($letters as $letter ){
//            foreach($letters as $char){
//               $this->createTable($char.$letter);
//            }
//        }

    }

    /**
     * 创建日签分表
     *
     *
     * @param $postfix
     * @create_at 18/5/1 下午1:25
     * @author 王玉翔
     */
    private function createTable($postfix){
        Schema::create('post_'.$postfix, function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('weather');//天气代号
            $table->string('location', 100);//地点
            $table->smallInteger('tag');//标签
            $table->string('pic', 200);//图片
            $table->string('sub_content', 200);//主要内容
            $table->smallInteger('words');//字数
            $table->integer('content_id')->default(0);//内容表主键值
            $table->tinyInteger('status')->default(1);//状态值1表示正常，0表示删除
            $table->tinyInteger('is_public')->default(0);//是否开放
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
        Schema::dropIfExists('post');
    }
}
