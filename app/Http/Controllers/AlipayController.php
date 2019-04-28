<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AlipayController extends Controller
{
    public function pay($s_sand)
    {


    	$subject = trim('商品支付');
        //付款金额，必填
        $data = DB::table('success')->where('s_sand',$s_sand)->first();
        $s_price=$data->s_price;
        $total_amount =$s_price ;
        //商品描述，可空
        $body = '';

        $config = config('alipay');
        require_once app_path('alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');

        //构造参数
        //php中new 一个类如果不写命名空间，就默认为与当前同命名空间
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($s_sand);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
       
        //输出表单
        var_dump($response);

    }


    public function returnaAlipay()
    {
        $config = config('alipay');

        require_once("config.php");
        require_once app_path('alipay/pagepay/service/AlipayTradeService.php');
        $arr=$_GET;
        $alipaySevice = new AlipayTradeService($config); 
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //请在这里加上商户的业务逻辑程序代码
        
        //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
        //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

        //商户订单号
        $where['s_sand'] = htmlspecialchars($_GET['out_trade_no']);
        $where['s_price'] = htmlspecialchars($_GET['total_amount']);
        $count=DB::table('success')->where($where)->count();
        dd($count);
        // if(!empty($count)){
        //     $result=json_encode($arr)
        //     exit('订单和金额不符，没有当前记录'.$result);
        // }

        //支付宝交易号
        $trade_no = htmlspecialchars($_GET['trade_no']);
            
        echo "验证成功<br />支付宝交易号：".$trade_no;

        //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                }
        else {
            //验证失败
            echo "验证失败";
        }
            }
}
