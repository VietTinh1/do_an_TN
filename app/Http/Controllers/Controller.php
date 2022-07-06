<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function multiArrayTotwodimensionArray($array,$remotenullrow=false)
    {
        $arr_Return=null;
        $maxlen=0;
        if(!empty($array))
        {
            foreach($array as $arr)
            {
                if(count($arr)>$maxlen)
                {
                    $maxlen=count($arr);
                }
            }
            for($i=0;$i<$maxlen;$i++)
            {
                foreach($array as $key=>$value)
                {
                    if(isset($value[$i]))
                    {
                        $arr_Return[$i][$key]=$value[$i];
                    }
                    else
                    {
                        $arr_Return[$i][$key]='';
                    }

                }
            }
            if($remotenullrow==true)
            {
                for($i=$maxlen-1;$i>=0;$i--)
                {
                    $is_null=true;
                    foreach($arr_Return[$i] as $value)
                    {
                        if(!empty($value))
                        {
                            $is_null=false;
                            break;
                        }
                    }
                    if($is_null==true)
                    {
                        array_splice($arr_Return,$i,1);

                    }
                }
            }
        }
        return $arr_Return;
    }

}
