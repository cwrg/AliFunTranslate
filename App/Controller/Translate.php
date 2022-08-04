<?php

namespace App\Controller;

use Core\App;
use Cwrg\Translates\Translate as TranslateService;

class Translate extends App
{
    /**
     * google翻译
     * @return false|string
     */
    public function google()
    {
        $content = TranslateService::google()
            ->source($this->param('source', 'auto'))
            ->target($this->param('target', 'en'))
            ->translate($this->param('text'));
        return $this->success(compact('content'));
    }

    /**
     * 百度翻译
     * @return false|string
     */
    public function baidu()
    {
        $config = [
            'appid' => $this->config('baidu.appid'),
            'key' => $this->config('baidu.key')
        ];
        $content = TranslateService::baidu($config)
            ->source($this->param('source', 'auto'))
            ->target($this->param('target', 'en'))
            ->translate($this->param('text'));
        return $this->success(compact('content'));
    }
}
