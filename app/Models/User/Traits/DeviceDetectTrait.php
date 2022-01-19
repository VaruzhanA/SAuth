<?php

namespace App\Models\User\Traits;

use App\Http\Constants\CommonConst;

/**
 * Class DeviceDetectTrait.
 */
trait DeviceDetectTrait
{


    /**
     * @return string
     */
    public function getDevice()
    {
        $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), CommonConst::TYPE_WINDOWS));
        $isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), CommonConst::TYPE_ANDROID));
        $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), CommonConst::TYPE_IPHONE));
        $isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), CommonConst::TYPE_IPAD));
        $isIOS = $isIPhone || $isIPad;

        if($isIOS){
            return CommonConst::TYPE_IOS;
        }elseif ($isAndroid){
            return CommonConst::TYPE_ANDROID;
        }else{
            return CommonConst::TYPE_WEB;
        }
    }

}
