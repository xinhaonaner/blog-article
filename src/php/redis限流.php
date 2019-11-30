<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 2019/11/30 10:22 上午
 */
try{
    $redis = new Redis();
    $redis->connect('127.0.0.1','6379',0.2);
    $redis->select(1);
    $prefix='CH';
    $hkBlaockIpKey='blackip_';//黑名单hash key
    $nowTime = intval(time().(str_pad(intval(microtime()*1000),3,'0',STR_PAD_LEFT)));
    $perQueryWait =  500;//500 毫秒每次访问间隔
    $blockIpTime = 60;//每个ip发封禁时间长短  以秒为单位
    // $nowTime2 = intval(time().(str_pad(intval(microtime()*1000),3,'0',STR_PAD_LEFT)));
    if($redis->get($hkBlaockIpKey.$_SERVER['REMOTE_ADDR'])){//ip 被封了
        exit('~_~');
    }
    $timeLastTime = $redis->get($prefix.$_SERVER['REMOTE_ADDR']);
    if(!$timeLastTime){
        $redis->set($prefix.$_SERVER['REMOTE_ADDR'],$nowTime,10);
    }else{
        if($nowTime-$timeLastTime<$perQueryWait){
            echo "<script>alert('您访问的也太快了吧,喝口水休息下吧');history.go(-1);</script>";exit;
        }else{//成功通过校验
            $redis->set($prefix.$_SERVER['REMOTE_ADDR'],$nowTime,10);
        }
    }

    //建立黑名单机智  如果某个ip 一直访问 某个接口     比如 访问 login.php  1s 一次 ，    在1分钟内访问某个php的地址超过 4 次  持续 拉入黑名单ip  封禁 24小时 。
    $checkKey = 'BH'.$_SERVER['REMOTE_ADDR'].'@'.$_SERVER['PHP_SELF'];
    $oneMiusQueryNum = $redis->get($checkKey);
    if(!$oneMiusQueryNum){
        $redis->incr($checkKey);
        $redis->expire($checkKey,60);
    }else{
        if($oneMiusQueryNum>4){//封禁ip
            $redis->set($hkBlaockIpKey.$_SERVER['REMOTE_ADDR'],1,$blockIpTime);//封禁
            exit('~_~');
        }else{//数据加1
            $redis->incr($checkKey);
        }
    }


}catch(Exception $e){

}