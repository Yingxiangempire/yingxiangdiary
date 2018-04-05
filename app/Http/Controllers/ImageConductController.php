<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/3/31
 * Time: 下午6:24
 */

namespace App\Http\Controllers;

use App\Http\Controllers\PublicService\LocationController;
use App\Http\Controllers\PublicService\WeatherController;
use Grafika\Grafika;
use Response;
use Grafika\Color;

class ImageConductController extends Controller
{
    public function index()
    {
        $imageFile = base_path('Image') . '/z.png';
        $editor = Grafika::createEditor();
        $editor->open($image, base_path('Image') . '/z.png');
        $property = getimagesize($imageFile);
//        $editor->resizeFit($image,1080,1920);//优先宽度等比例缩放
        $editor->resizeExactWidth($image, 1080);//等宽缩放
//        $editor->resizeExactHeight($image , 1920);//等宽缩放
//        $filter = Grafika::createFilter('Grayscale');
//        $editor->apply( $image, $filter );
        $editor->text($image, '王玉翔', 50, 200, 100, new Color("#000000"), base_path('Image') . '/font.ttf', 0);
        $editor->save($image, base_path('Image') . '/k.png');
        $im = @imagecreatefrompng(base_path('Image') . '/k.png');
        ob_start();
        imagepng($im);
        $content = ob_get_contents();
        imagedestroy($im);
        ob_end_clean();
        return Response::make($content)->header('Content-Type', 'image/png');
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
        $weather = new WeatherController();
        $result = $weather->getWeatherByIp('180.169.86.54');
        dump($result);
    }

}