<?php

namespace bihuo;

//use Core\Exceptions\NoFileException;
/**
 * 获取配置的文件
 * Class Config
 * @package Core\Lib
 */
class Config
{

    private $configs = [];

    /**
     * 获取某个文件的某个配置参数值
     * @param $file
     * @param bool $key
     * @return mixed|null
     */
    public function get($file, $key = false)
    {
        return $this->getKeyInArr($this->getFileArr($file), $key);
    }

    /**
     * 获取配置文件的数据
     * @param $file
     * @return mixed
     *
     */
    protected function getFileArr($file)
    {
        if (isset($this->configs[$file])) {
            return $this->configs[$file];
        }
        $file =__DIR__ . '/config/' . $file . '.php';
        if (!is_file($file)) {
            return $this->configs[$file] = [];
        }
        return $this->configs[$file] = require $file;
    }

    /**
     * 使用 . 语法 在数组中获取键  值不存在，直接返回 null
     * @param $arr
     * @param $key
     * @return mixed|null
     */
    protected function getKeyInArr($arr, $key)
    {
        // 如果没有 key 则返回整个配置文件
        if ($key === false) {
            return $arr;
        }
        // 如果没有. 则直接返回这个键
        if (strpos($key, '.') === false) {
            return $arr[$key];
        }

        foreach (explode('.', $key) as $segment) {
            $arr = $arr[$segment];
        }
        return $arr;
    }
}