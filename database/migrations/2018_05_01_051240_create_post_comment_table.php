<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('p_id')->default(0);
            $table->string('content', 500);
            $table->timestamps();
        });
//        $letters=['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'];
//        foreach ($letters as $letter ){
//            foreach($letters as $char){
//                $this->createTable($char.$letter);
//            }
//        }
    }

    /**
     * 创建评论表
     *
     * @param $postfix
     * @create_at 18/5/1 下午1:57
     * @author 王玉翔
     */
    private function createTable($postfix)
    {
        Schema::create('post_comment_'.$postfix, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('p_id')->default(0);
            $table->string('content', 500);
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
        Schema::dropIfExists('post_comment');
    }
}
