<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/3/31
 * Time: 下午6:24
 */

namespace App\Http\Controllers;

use App\Http\Controllers\PublicService\LocationController;
use App\Http\Controllers\PublicService\LunarDayController;
use App\Http\Controllers\PublicService\WeatherController;
use Grafika\Grafika;
use Grafika\Imagick\Image;
use Response;
use Grafika\Color;

class ImageConductController extends Controller
{

    protected $editor='';
    protected $mainImg='';

   public function __construct($width=640,$height=920)
   {
       $this->editor=Grafika::createEditor();
       $this->mainImg=Grafika::createBlankImage($width, $height);
       $this->editor->fill($this->mainImg, new Color('#ba8448'));
   }

    public function index()
    {
        $data = ["weather" => "多云", "city" => "上海", "week" => "星期四", "img" => "1", "date" => "2018-04-05"];
        $weatherImg = '2';
        $editor = Grafika::createEditor();
        $imageMain = Grafika::createBlankImage(640, 960);
        $editor->fill($imageMain, new Color('#ba8448'));
        $editor->open($location, base_path('Image') . '/location.png');
        $editor->open($weather, base_path('Image') . '/weathercn/' . $data['img'] . '.png');
        $editor->open($baseImage, base_path('Image') . '/transparencybase.jpg');
        $editor->open($date, base_path('Image') . '/dates.png');
        $editor->open($inputImage, base_path('Image') . '/input.jpeg');
        $editor->open($underline, base_path('Image') . '/underline.png');
        $editor->resizeFill($inputImage, 640, 600);
//        $editor->resizeFit($inputImage,640,800);//优先宽度等比例缩放
//        $editor->resizeExactWidth($inputImage, 640);//等宽缩放
//        $editor->resizeExactHeight($inputImage , 600);//等宽缩放
//        $filter = Grafika::createFilter('Grayscale');
//        $editor->apply( $image, $filter );
//        $filter = Grafika::createFilter('Colorize', 10,45,6);
//        $editor->apply( $baseImage, $filter );
        $editor->blend($baseImage, $weather, 'normal', 9, 'top-left', 10, 0);
        $editor->blend($baseImage, $location, 'normal', 9, 'top-left', 490, 0);
        $editor->text($baseImage, $data['weather'], 18, 90, 30, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($baseImage, $data['city'], 18, 560, 30, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, '映像日签', 15, 280, 935, new Color('#FFFFFF'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->blend($inputImage, $baseImage, 'screen', 1, 'bottom-center');
//        $editor->blend ($imageMain,$inputImage, 'normal',9,'top-left',10,0);

        $editor->blend($imageMain, $inputImage, 'normal', 0.9, 'top-left');
        $editor->blend($imageMain, $date, 'normal', 1, 'bottom-left', 10, -80);
        $editor->blend($imageMain, $underline, 'normal', 1, 'bottom-left', 300, -90);
        $editor->blend($imageMain, $underline, 'normal', 1, 'bottom-left', 300, -140);
        $editor->blend($imageMain, $underline, 'normal', 1, 'bottom-left', 300, -190);
        $editor->blend($imageMain, $underline, 'normal', 1, 'bottom-left', 300, -240);

        $editor->text($imageMain, '清明时节雨纷纷，', 18, 350, 690, new Color('#130c0e'), base_path('Image') . '/ttf/hand.ttf',
            0);
        $editor->text($imageMain, '路上行人欲断魂。', 18, 350, 740, new Color('#130c0e'), base_path('Image') . '/ttf/hand.ttf',
            0);
        $editor->text($imageMain, '借问酒家何处有？', 18, 350, 790, new Color('#130c0e'), base_path('Image') . '/ttf/hand.ttf',
            0);
        $editor->text($imageMain, '牧童遥指杏花村.', 18, 350, 840, new Color('#130c0e'), base_path('Image') . '/ttf/hand.ttf',
            0);


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
        $weather = new WeatherController();
        $date = $weather->Cal(date('Y'), date('m'), date('d'));
        $weekarray = array("日", "一", "二", "三", "四", "五", "六");
        $editor = Grafika::createEditor();
        $editor->open($imageMain, base_path('Image') . '/date_base.jpeg');
        $editor->text($imageMain, date('Y/m'), 20, 58, 30, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf',
            0);
        $editor->text($imageMain, date('d'), 77, 50, 72, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, '农历', 10, 20, 82, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, $date['month'], 10, 20, 107, new Color('#000000'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, $date['day'], 10, 20, 132, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf',
            0);
        $editor->text($imageMain, "星期" . $weekarray[date("w")], 20, 67, 175, new Color('#000000'),
            base_path('Image') . '/ttf/wryh.ttf', 0);

        $editor->save($imageMain, base_path('Image') . '/dates.png');
        $im = @imagecreatefrompng(base_path('Image') . '/dates.png');
        ob_start();
        imagepng($im);
        $content = ob_get_contents();
        imagedestroy($im);
        ob_end_clean();
        return Response::make($content)->header('Content-Type', 'image/png');

    }


    public function getQuickStyleImg()
    {
        $data = ["weather" => "多云", "city" => "苏州 西交利物浦大学", "week" => "星期四", "img" => "1", "date" => "2018-04-05"];
        //创建主画布,在底部添加天气与地点
        $editor = Grafika::createEditor();
        $imageMain = Grafika::createBlankImage(640, 960);
        //获取主图
        $editor->open($inputImage, base_path('Image') . '/input.jpeg');
        //复制主图,拉升至主图的尺寸作为背景
        $copy = clone $inputImage;
        $editor->resizeFill($inputImage, 640, 960);
        $editor->blend($imageMain, $inputImage, 'normal', 1, 'center', 0, 0);
        $editor->open($location, base_path('Image') . '/location.png');
        $editor->resizeFit($location, 40, 40);//优先宽度等比例缩放
        $editor->open($pen, base_path('Image') . '/pen.png');
        $editor->resizeFit($pen, 80, 80);//优先宽度等比例缩放
        $editor->open($weather, base_path('Image') . '/weathercn/' . $data['img'] . '.png');
        $editor->resizeFit($weather, 40, 40);//优先宽度等比例缩放
        $editor->fill($imageMain, new Color('#ba8448'));
        $editor->blend($imageMain, $weather, 'normal', 9, 'bottom-left', 10, -5);
        $editor->blend($imageMain, $location, 'normal', 9, 'bottom-left', 430, -5);
        $editor->text($imageMain, $data['weather'], 13, 55, 930, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, $data['city'], 13, 470, 930, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        //制作拍立得背景
        //1 白色背景画布
        $imageSub = Grafika::createBlankImage(600, 760);
        $editor->fill($imageSub, new Color('#FFFFFF'));

        //2 添加时间日期
        $date = getdate(mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
        $day = $date['month'] . ' ' . $date['mday'] . ',' . $date['year'];// April 10,2018
        $editor->text($imageSub, $day, 18, 30, 555, new Color('#130c0e'), base_path('Image') . '/ttf/englishDate.ttf',
            0);
        $editor->text($imageSub, $date['weekday'], 18, 500, 555, new Color('#130c0e'),
            base_path('Image') . '/ttf/englishDate.ttf', 0);

        //3 添加主图
        $editor->resizeFill($copy, 590, 540);
        $editor->blend($imageSub, $copy, 'normal', 1, 'top-left', 5, 5);

        //4 添加文字
        $editor->text($imageSub, '今日的母校已是高楼林立，南北校区与整个园区融洽的
结合在一起。已回想不起10年第一次来到南方，第一次来
到这里时的懵B情景，倒是挺疑惑自己当时哪来的勇气，
跑那么远来这', 16, 30, 590, new Color('#130c0e'), base_path('Image') . '/ttf/hand.ttf',
            0);
        $editor->blend($imageSub, $pen, 'normal', 1, 'bottom-right', 0, 0);

        $editor->blend($imageMain, $imageSub, 'normal', 1, 'center', 0, -30);


        $editor->save($imageMain, base_path('Image') . '/quick.png');
        $im = @imagecreatefrompng(base_path('Image') . '/quick.png');
        ob_start();
        imagepng($im);
        $content = ob_get_contents();
        imagedestroy($im);
        ob_end_clean();
        return Response::make($content)->header('Content-Type', 'image/png');
    }

    public function getVisitPics()
    {
        $pics = [7, 8, 9];
        $name = 97;
        foreach ($pics as $pic) {
            for ($i = 1; $i < 17; $i++) {
                $this->getVisitPic($pic, $name);
                $name++;
            }
        }
    }


    public function getVisitPic($key, $name)
    {
        $data = ["weather" => "多云", "city" => "甘肃 敦煌", "week" => "星期四", "img" => "1", "date" => "2018-04-05"];
        //创建主画布,在底部添加天气与地点
        $editor = Grafika::createEditor();
        $imageMain = Grafika::createBlankImage(640, 960);
        //获取主图
        $editor->open($bgImage, base_path('Image') . '/visit/1.jpeg');

        //添加天气与位置图标
        $editor->resizeFill($bgImage, 640, 960);
        $editor->blend($imageMain, $bgImage, 'normal', 1, 'center', 0, 0);


        //添加最上方日期
        $date = getdate(mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
        $day = $date['mday'];
        $editor->text($imageMain, $day, 50, 310, 50, new Color('#FFFFFF'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, strtoupper(gmstrftime('%b')) . '.' . $date['weekday'], 18, 250, 110,
            new Color('#FFFFFF'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, '映像日签', 14, 285, 140, new Color('#FFFFFF'), base_path('Image') . '/ttf/wryh.ttf', 0);

        $editor->open($inputImage, base_path('Image') . '/visit/' . $key . '.jpeg');
        $editor->resizeFill($inputImage, 500, 750);
        $editor->open($location, base_path('Image') . '/location.png');
        $editor->resizeFit($location, 40, 40);//优先宽度等比例缩放
        $editor->open($weather, base_path('Image') . '/weathercn/' . $data['img'] . '.png');
        $editor->resizeFit($weather, 40, 40);//优先宽度等比例缩放

        $editor->blend($inputImage, $weather, 'normal', 9, 'bottom-left', 10, -5);
        $editor->blend($inputImage, $location, 'normal', 9, 'bottom-left', 380, -5);
        $editor->text($inputImage, $data['weather'], 13, 55, 720, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($inputImage, $data['city'], 13, 420, 720, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->blend($imageMain, $inputImage, 'normal', 9, 'center', 0, 55);


        $editor->save($imageMain, base_path('Image') . '/visits/' . $name . '.jpeg');
//        $im = @imagecreatefrompng(base_path('Image') . '/visits/'.$key.'.png');
//        ob_start();
//        imagepng($im);
//        $content = ob_get_contents();
//        imagedestroy($im);
//        ob_end_clean();
//        return Response::make($content)->header('Content-Type', 'image/png');


    }


    public function getThinkPic()
    {
        $data = ["weather" => "晴", "city" => "上海", "img" => "0"];
        $editor = Grafika::createEditor();
        $imageMain = Grafika::createBlankImage(640, 960);
        $editor->fill($imageMain, new Color('#E8E4E1'));

        //获取齿轮背景图
        $editor->open($bgImage, base_path('Image') . '/bg.jpeg');
        $editor->resizeExact($bgImage, 600, 950);//等宽缩放

        //添加上方日期(年/月份/日/星期)
        $weather = new WeatherController();
        $date = getdate(mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
        $year = $date['year'];
        $editor->text($bgImage, $year, 16, 250, 50, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($bgImage, $weather->monthUpper[$date['mon']], 16, 253, 75, new Color('#000000'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($bgImage, $date['mday'], 28, 260, 100, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->draw($bgImage,
            Grafika::createDrawingObject('Line', array(250, 135), array(295, 135), 14, new Color('#000000')));//添加横线
        $editor->text($bgImage, $date['weekday'], 16, 235, 140, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);

        //添加文字
        $editor->text($bgImage, '//写不完的功能', 16, 200, 780, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($bgImage, '//改不完的BUG', 16, 200, 810, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);

        //添加底部画笔LOGO
        $editor->open($pen, base_path('Image') . '/pen.png');
        $editor->resizeFit($pen, 80, 80);//优先宽度等比例缩放
        $editor->blend($bgImage, $pen, 'normal', 1, 'bottom-center', 0, -20);

        //获取主图并添加天气与地点
        $editor->open($inputImage, base_path('Image') . '/tk.jpeg');
        $editor->resizeFill($inputImage, 500, 550);
        $editor->open($location, base_path('Image') . '/location.png');
        $editor->resizeFit($location, 40, 40);//优先宽度等比例缩放
        $editor->open($weather, base_path('Image') . '/weathercn/' . $data['img'] . '.png');
        $editor->resizeFit($weather, 40, 40);//优先宽度等比例缩放
        $editor->blend($inputImage, $weather, 'normal', 9, 'bottom-left', 10, -5);
        $editor->blend($inputImage, $location, 'normal', 9, 'bottom-left', 380, -5);
        $editor->text($inputImage, $data['weather'], 13, 55, 520, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($inputImage, $data['city'], 13, 420, 520, new Color('#FFFFFF'),
            base_path('Image') . '/ttf/wryh.ttf', 0);

        //主图与背景图合并
        $editor->blend($bgImage, $inputImage, 'normal', 9, 'center', 0, 0);

        //背景与画布合并
        $editor->blend($imageMain, $bgImage, 'normal', 9, 'center', 0, 0);
        $editor->save($imageMain, base_path('Image') . '/think.png');
        $im = @imagecreatefrompng(base_path('Image') . '/think.png');
        ob_start();
        imagepng($im);
        $content = ob_get_contents();
        imagedestroy($im);
        ob_end_clean();
        return Response::make($content)->header('Content-Type', 'image/png');
    }



    public function getHopePic()
    {
        $data = ["weather" => "晴", "city" => "上海", "img" => "0"];
        $editor = Grafika::createEditor();
        $imageMain = Grafika::createBlankImage(640, 960);
        $editor->fill($imageMain, new Color('#FFFFFF'));

        //获取主图并合并至主图
        $editor->open($inputImage, base_path('Image') . '/visit/1.jpeg');
        $editor->resizeFill($inputImage, 640, 500);
        $editor->blend($imageMain, $inputImage, 'normal', 9, 'top-center', 0, 0);
        //添加日期
        $editor->draw($imageMain,
            Grafika::createDrawingObject('Line', array(40, 430), array(170, 430), 14, new Color('#000000')));//添加横线
        $editor->draw($imageMain,
            Grafika::createDrawingObject('Line', array(40, 430), array(40, 580), 14, new Color('#000000')));//添加横线
        $editor->draw($imageMain,
            Grafika::createDrawingObject('Line', array(170, 430), array(170, 580), 14, new Color('#000000')));//添加横线
        $editor->draw($imageMain,
            Grafika::createDrawingObject('Line', array(40, 580), array(60, 580), 14, new Color('#000000')));//添加横线
        $editor->draw($imageMain,
            Grafika::createDrawingObject('Line', array(150,580), array(170, 580), 14, new Color('#000000')));//添加横线
        $weather = new WeatherController();
        $date = $weather->Cal(date('Y'), date('m'), date('d'));
        $dates = getdate(mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
        $editor->text($imageMain, date('Ym'), 18, 65, 450, new Color('#FFFFFF'), base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, date('d'), 42, 75, 480, new Color('#000000'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, '农历 '.$date['month'].$date['day'], 8, 70, 540, new Color('#000000'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, $dates['weekday'], 14, 65, 570, new Color('#000000'), base_path('Image') . '/ttf/wryh.ttf', 0);

        //添加天气与地点

        $editor->open($location, base_path('Image') . '/location.png');
        $editor->resizeFit($location, 40, 40);//优先宽度等比例缩放
        $editor->open($weather, base_path('Image') . '/weathercn/' . $data['img'] . '.png');
        $editor->resizeFit($weather, 40, 40);//优先宽度等比例缩放
        $editor->blend($imageMain, $weather, 'normal', 9, 'bottom-left', 10, -5);
        $editor->blend($imageMain, $location, 'normal', 9, 'bottom-left', 520, -5);
        $editor->text($imageMain, $data['weather'], 13, 55, 930, new Color('#000000'),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $editor->text($imageMain, $data['city'], 13, 560, 930, new Color('#000000'),
            base_path('Image') . '/ttf/wryh.ttf', 0);


        //添加文字

        $editor->text($imageMain, '重构', 80, 220, 680, new Color('#000000'),
            base_path('Image') . '/ttf/hand.ttf', 0);


        //添加底部画笔LOGO
        $editor->open($pen, base_path('Image') . '/pen.png');
        $editor->resizeFit($pen, 80, 80);//优先宽度等比例缩放
        $editor->blend($imageMain, $pen, 'normal', 1, 'bottom-center', 0,0);

        $editor->save($imageMain, base_path('Image') . '/hope.png');
        $im = @imagecreatefrompng(base_path('Image') . '/hope.png');
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
//        $date = getdate(mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));
//        dump($date);
//        dump(gmstrftime('%w'));
//        $week = $date['weekday'];
////          $date=new LunarDayController();
////        $location=new LocationController();
////        $result=$location->getLocationByIP('180.169.86.54');
////        dump($result);
//        $weather = new WeatherController();
//        dump($weather->monthUpper['2']);
//
//        $weather->monthUpper['2'];
//        $result = $weather->getWeatherByIp('220.112.125.170');
////        dump($weather->Cal(date('Y'), date('m'), date('d')));
////        $s=$asss->Cal(2016,3,21);
//        dump($result);

//        $imageMain = Grafika::createBlankImage(640, 960);
//        $editor->fill($imageMain, new Color('0,0,0',0));
//
//        $editor->save($imageMain, base_path('Image') . '/test.png');
//        $im = @imagecreatefrompng(base_path('Image') . '/test.png');
//        ob_start();
//        imagepng($im);
//        $content = ob_get_contents();
//        imagedestroy($im);
//        ob_end_clean();
//        return Response::make($content)->header('Content-Type', 'image/png');


        $wl=$this->getWeatherAndLocation(1,'hao','江苏积极急地点','#FFFFFF',500);
        $this->editor->resizeExactWidth($wl, 540);
        $this->editor->open($inputImage, base_path('Image') . '/visit/1.jpeg');
        $this->editor->resizeFill($inputImage, 640, 500);
        $this->editor->blend($inputImage, $wl, 'screen', 1, 'bottom-center', 0,0);
        $this->editor->blend($this->mainImg, $inputImage, 'normal', 9, 'bottom-center', 0,0);
        return $this->saveAndShow($this->mainImg);
    }

    /**
     * 获取天气与地址图片
     *
     * @param $weatherImgNum
     * @param $weatherString
     * @param $locationString
     * @param string $color
     * @param int $width
     * @param int $height
     * @return mixed
     * @create_at 18/4/12 下午11:33
     * @author 王玉翔
     */
    public function getWeatherAndLocation($weatherImgNum,$weatherString,$locationString,$color='#FFFFFF',$width=640,$height=72)
    {
        $this->editor->open($wl, base_path('Image') . '/base/transparency.png');//获取透明背景图片
        $this->editor->resizeExact($wl, $width, $height);//等宽缩放
        $this->editor->open($location, base_path('Image') . '/location.png');
        $this->editor->open($weather, base_path('Image') . '/weathercn/' . $weatherImgNum . '.png');
        $this->editor->resizeFit($location, 40, 40);
        $this->editor->resizeFit($weather, 40, 40);
        $this->editor->blend($wl, $weather, 'normal', 1, 'bottom-left', 10, -5);
        $this->editor->blend($wl, $location, 'normal', 1, 'bottom-right', -20-mb_strlen($locationString)*14, -5);
        $this->editor->text($wl, $weatherString, 13, 55, 45, new Color($color),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        $this->editor->text($wl, $locationString, 13, $width-20-mb_strlen($locationString)*14, 40, new Color($color),
            base_path('Image') . '/ttf/wryh.ttf', 0);
        return $wl;
    }

    /**
     * 保存图片
     *
     * @param $imageResource
     * @param $fileName
     * @param string $path
     * @create_at 18/4/11 下午11:03
     * @author 王玉翔
     */
    public function save($imageResource,$fileName,$path=''){
        $path=$path?:base_path('Image');
        $this->editor->save($imageResource, $path . $fileName);
    }

    /**
     * 保存并测试输出图片
     *
     * @param $imageMain
     * @return $this
     * @create_at 18/4/11 下午10:55
     * @author 王玉翔
     */
    protected function saveAndShow($imageMain)
    {
        $this->editor->save($imageMain, base_path('Image') . '/test.png');
        $im = @imagecreatefrompng(base_path('Image') . '/test.png');
        ob_start();
        imagepng($im);
        $content = ob_get_contents();
        imagedestroy($im);
        ob_end_clean();
        return Response::make($content)->header('Content-Type', 'image/png');
    }

}