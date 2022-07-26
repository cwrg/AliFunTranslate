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
        try {
            $content = TranslateService::google()
                ->target($this->param('target', 'en'))
                ->source($this->param('source', ''))
                ->translate($this->param('text', ''));
            return $this->success(compact('content'));
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * 百度翻译
     * @return false|string
     */
    public function baidu()
    {
        try {
            $config = [
                'appid' => $this->config('baidu.appid'),
                'key' => $this->config('baidu.key')
            ];
            $content = TranslateService::baidu($config)
                ->source($this->param('target', 'auto'))
                ->target($this->param('source', 'en'))
                ->translate($this->param('text', ''));
            return $this->success(compact('content'));
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
}
