<?php
use Illuminate\Support\Facades\Storage;

/**
 * Alter request data
 *
 * @param $request
 * @return mixed
 */
function removeTokenFromRequestData($request)
{
    unset($request['token']);
    if(isset($request['g_recaptcha'])){
        unset($request['g_recaptcha']);
    }
    foreach ($request as $key=>$item){
        if(!is_array($item)){
            $val = trim($item);
            $val = _cleanInput($val);
            $request[$key] = $val;
        }
    }
    return $request;
}

function _cleanInput($string) {
    return preg_replace('/-+/', '-', $string);
}

function getLoggedInUser($as_array = false,$asAPIuser = false)
{
    if($asAPIuser){
        $user = auth('api')->user();
    }else{
        $user = Auth::user() ? Auth::user() : auth('api')->user();//auth('api')->user();
    }

    if($as_array){
        return $user->toArray();
    }

    return $user;
}


function imageUrl($resourceId, $imagePath, $size = 'medium')
{
    $imageUrl = env('APP_URL').'/img/320x240.png';
    if ($imagePath) {
        $imageUrl = Storage::disk('product')->url(''.$resourceId.'/'.$size.'/'.$imagePath.'');
    }
    return $imageUrl;
}
