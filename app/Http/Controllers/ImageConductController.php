<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/3/31
 * Time: 下午6:24
 */

namespace App\Http\Controllers;

use App\Http\Controllers\PublicService\LocationController;
use App\Http\Controllers\PublicService\LunarDateController;
use App\Http\Controllers\PublicService\WeatherController;
use Grafika\Grafika;
use Response;
use Grafika\Color;

class ImageConductController extends Controller
{
    public function index()
    {
        $data= ["weather" => "多云","city" => "上海","week" => "星期四","img" => "1","date" => "2018-04-05"];
        $weatherImg='2';
        $editor = Grafika::createEditor();
        $imageMain = Grafika::createBlankImage(640,960);
        $editor->fill ($imageMain,new Color('#ba8448'));
        $editor->open($location, base_path('Image') . '/location.png');
        $editor->open($weather, base_path('Image') . '/weathercn/'.$data['img'].'.png');
        $editor->open($baseImage, base_path('Image') . '/base.jpg');
        $editor->open($date, base_path('Image') . '/date.png');
        $editor->open($inputImage, base_path('Image') . '/input.png');
        $editor->resizeExact($inputImage , 640 , 600);
//        $editor->resizeFit($inputImage,640,960);//优先宽度等比例缩放
//        $editor->resizeExactWidth($inputImage, 640);//等宽缩放
//        $editor->resizeExactHeight($inputImage , 960);//等宽缩放
//        $filter = Grafika::createFilter('Grayscale');
//        $editor->apply( $image, $filter );
//        $filter = Grafika::createFilter('Colorize', 10,45,6);
//        $editor->apply( $baseImage, $filter );
        $editor->blend ($baseImage,$weather, 'normal',9,'top-left',10,0);
        $editor->blend ($baseImage,$location, 'normal',9,'top-left',490,0);
        $editor->text($baseImage, $data['weather'],18, 90,  30, new Color('#FFFFFF'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($baseImage, $data['city'], 18,560, 30, new Color('#FFFFFF'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->blend ($inputImage,$baseImage, 'screen',1,'bottom-center');
//        $editor->blend ($imageMain,$inputImage, 'normal',9,'top-left',10,0);

        $editor->blend ($imageMain, $inputImage , 'normal', 0.9, 'top-left');
        $editor->blend ($imageMain,$date, 'normal',1,'bottom-left',10,-70);
        $editor->save($imageMain, base_path('Image') . '/locations.png');
        $im = @imagecreatefrompng(base_path('Image') . '/locations.png');
        ob_start();
        imagepng($im);
        $content = ob_get_contents();
        imagedestroy($im);
        ob_end_clean();
        return Response::make($content)->header('Content-Type', 'image/png');
    }


    public function getDateImage()
    {

    }






    /**
     * 判断是横图还是竖图
     *
     * @param $width
     * @param $height
     * @return bool
     * @create_at 18/3/31 下午7:15
     * @author 王玉翔
     */
    public function isVertical($width, $height)
    {
        return $width < $height;
    }


    public function test()
    {
//        $location=new LocationController();
//        $result=$location->getLocationByIP('180.169.86.54');
//        dump($result);
//        $weather = new WeatherController();
//        $result = $weather->getWeatherByIp('123.125.71.38');
//        dump($result);
        $asss=new LunarDateController();
        $s=$asss->Cal(2016,3,21);
        dump($s);
    }

}