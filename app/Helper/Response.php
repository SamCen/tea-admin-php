<?php
/**
 * Author sam
 * DateTime 2019-05-22 17:35
 * Description:返回体函数
 */
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

if(!function_exists('apiResponse')){
    /**
     * Author sam
     * DateTime 2019-05-22 17:57
     * Description:api返回体
     * @param array $res
     * @param string $msg
     * @param int $code
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     */
    function apiResponse($res = [], $msg = '请求成功', $code = Response::HTTP_OK, array $header = []){
        if($res instanceof LengthAwarePaginator){
            $data = [
                'list'=> $res->items(),
                'total'=> $res->total(),
            ];
        }else{
            $data = $res ?: NULL;
        }
        return \response()->json([
            'code'=>$code,
            'msg'=>$msg,
            'time'=>time(),
            'data'=>$data,
        ],$code,$header)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}

if(!function_exists('success')){
    /**
     * Author sam
     * DateTime 2019-05-22 17:57
     * Description:请求成功
     * @param null $res
     * @param string $msg
     * @param int $code
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     */
    function success($res = null,$msg = '请求成功',$code = Response::HTTP_OK,array $header = []){
        return apiResponse($res,$msg,$code,$header);
    }
}

if(!function_exists('error')){
    /**
     * Author sam
     * DateTime 2019-05-22 17:57
     * Description:请求失败
     * @param string $msg
     * @param null $res
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function error($msg = '请求失败',$code = Response::HTTP_BAD_REQUEST,$res = null){
        return apiResponse($res,$msg,$code,$header = []);
    }
}

if(!function_exists('notFound')){
    /**
     * Author sam
     * DateTime 2019-05-22 17:57
     * Description:404返回
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function notFound($msg = '资源不存在',$code = 404){
        return apiResponse($res = [],$msg,$code,$header = []);
    }
}

if(!function_exists('unAuthorized')){
    /**
     * Author sam
     * DateTime 2019-05-22 17:57
     * Description:401返回
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function unAuthorized($msg = '认证失败',$code = 401){
        return apiResponse($res = [],$msg,$code,$header = []);
    }
}
