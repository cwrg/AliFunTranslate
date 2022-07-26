<?php

namespace Core;
class App
{

    protected $request;

    protected $response;

    protected $config;

    public function __construct($request)
    {
        $this->request = $request;
        $this->load();
    }

    /**
     * 加载配置
     * @return void
     */
    private function load()
    {
        $file = __DIR__ . '/../' . '.env';
        if (is_file($file)) {
            $env = parse_ini_file($file, true);
            foreach ($env as $key => $val) {
                $name = Env::ENV_PREFIX . strtoupper($key);
                if (is_array($val)) {
                    foreach ($val as $k => $v) {
                        $item = $name . '_' . strtoupper($k);
                        putenv("$item=$v");
                    }
                } else {
                    putenv("$name=$val");
                }
            }
        }
        $this->config = include __DIR__ . '/Config.php';
    }

    /**
     * 运行框架
     * @return false|mixed|string
     */
    public function run()
    {
        try {
            list($controller, $action) = explode('/', ltrim($this->request->getAttribute('path'), '/'));
        } catch (\Exception $e) {
            return $this->error('404 Not Found', 404);
        }
        $controller = "App\\Controller\\" . ucwords($controller);
        if (!class_exists($controller)) {
            return $this->error('404 Not Found', 404);
        }
        $class = new $controller($this->request);
        if (!method_exists($class, $action)) {
            return $this->error('404 Not Found', 404);
        }

        return call_user_func([$class, $action]);
    }

    /**
     * 获取配置
     * @param $name
     * @param $default
     * @return mixed
     */
    public function config($name, $default = null)
    {
        return array_get($this->config, $name, $default);
    }

    /**
     * @return array
     */
    public function params(): array
    {
        return $this->request->getQueryParams();
    }

    /**
     * @param $name
     * @param $default
     * @return mixed
     */
    public function param($name, $default = null)
    {
        return array_get($this->params(), $name, $default);
    }

    /**
     * @return string[]
     */
    public function headers(): array
    {
        return ['Content-Type' => 'application/json'];
    }

    /**
     * 返回数据
     * @return false|string
     */
    protected function response()
    {
        return json_encode($this->response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 成功
     * @param string $msg
     * @param $data
     * @param int $code
     * @return false|string
     */
    protected function success($data, string $msg = 'success', int $code = 0)
    {
        $this->response = compact('msg', 'data', 'code');
        return $this->response();
    }

    /**
     * 失败
     * @param $msg
     * @param int $code
     * @param $data
     * @return false|string
     */
    protected function error($msg, int $code = -1, $data = null)
    {
        $this->response = compact('msg', 'data', 'code');
        return $this->response();
    }
}
