<?php
namespace App\Http\Controllers\PublicService;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class LocationController extends Controller
{
    const HOST = "https://dm-81.data.aliyun.com";//阿里云根据IP查询省市区位置
    const PATH = "/rest/160601/ip/getIpInfo.json";

    const APP_KEY = '24842639';  //阿里云网址 https://market.console.aliyun.com/imageconsole/index.htm?spm=a2c4g.11186623.2.3.y7Tv6B#/bizlist?_k=760pjy
    const APP_SECRET = 'e21acb8b1a3db21cf06b157b8d78f809';
    const APP_CODE = 'b72c95ffb0934a6392fcf8bbf5f2ee72';


    /**
     * 根据IP获取地理位置   
     *
     * @param $ip
     * @return mixed
     * @throws \Exception
     * @create_at 18/4/4 下午7:31
     * @author 王玉翔
     */
    public function getLocationByIP($ip)
    {
        $result = $this->sendRequest(self::HOST . self::PATH . '?ip=' . $ip);
        //验证返回结果
        if (!$result['code']){
            return $result['data'];
        }else {
            throw new \Exception('获取位置信息接口报错');
        }
    }


    /**
     * 发送请求
     *
     * @param $url
     * @return mixed
     * @throws \Exception
     * @create_at 18/4/4 下午8:48
     * @author 王玉翔
     */
    public static function sendRequest($url)
    {
        $client = new Client();
        $request = new Request('GET', $url,
            ['Authorization' => 'APPCODE ' . self::APP_CODE, 'X-Ca-Key' => self::APP_KEY]);
        $res = $client->send($request);
        if ($res->getStatusCode() == 200) {
            return json_decode($res->getBody(), true);
        } else {
            $result = json_decode($res->getBody());
            if (property_exists($result, 'error_description')) {
                throw new \Exception($result->error_description, $res->getStatusCode());
            } else {
                throw new \Exception($result->error_msg, $result->error_code);
            }
        }

    }
    
    


}
