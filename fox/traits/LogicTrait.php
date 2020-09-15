<?php


namespace fox\traits;


trait LogicTrait
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * 实例化本身
     * @var object
     */
    protected static $instance;

    /**
     * 配置参数
     * @param array $config
     */
    protected function setConfig(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->set($this->items, $key, $value);
        }
    }

    /**
     * 设置参数
     * @param $array
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function set(&$array, $key, $value)
    {
        if (is_null($key)) return $array = $value;
        $keys = explode('.', $key);
        while (count($keys) > 1) {
            $key = array_shift($keys);
            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }
            $array = &$array[$key];
        }
        $array[array_shift($keys)] = $value;
        return $array;
    }

    /**
     * 实例化类
     */
    protected function registerProviders()
    {
        if (property_exists($this, 'providers')) {
            foreach ($this->providers as $key => $provider) {
                $this->register(new $provider(), $key);
            }
        }
    }

    /**
     * 获取类内配置信息
     * @param object $pimple
     * @return $this
     * */
    protected function register($pimple, $key)
    {
        $response = $pimple->register($this->items);
        if (is_array($response)) {
            [$key, $provider] = $response;
            $this->$key = $provider;
        } else if (is_string($key)) {
            $this->$key = $pimple;
        }
        return $this;
    }

    /**
     * 实例化本类
     * @param array $config
     * @return $this
     * */
    public static function instance($config = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            self::$instance->setConfig($config);
            self::$instance->registerProviders();
            if (method_exists(self::$instance, 'bool'))
                self::$instance->bool();
        }
        return self::$instance;
    }
}