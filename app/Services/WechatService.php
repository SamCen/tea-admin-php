<?php

namespace App\Services;

class WechatService
{
    private $appid;

    private $secret;

    public function __construct($appid,$secret)
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }

    public function getUserInfoByCode($code)
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->secret}&code={$code}&grant_type=authorization_code";
        $res = file_get_contents($url);
        return json_decode($res,true);
    }
}
