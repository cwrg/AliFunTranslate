<?php
// +----------------------------------------------------------------------

namespace Core;

class Env
{
    const ENV_PREFIX = 'PHP_ENV_';

    /**
     * 获取环境变量值
     * @param $name
     * @param $default
     * @return array|bool|mixed|string|null
     */
    public static function get($name, $default = null)
    {
        $result = getenv(self::ENV_PREFIX . strtoupper(str_replace('.', '_', $name)));
        if (false !== $result) {
            if ('false' === $result) {
                $result = false;
            } elseif ('true' === $result) {
                $result = true;
            }
            return $result;
        }
        return $default;
    }
}
