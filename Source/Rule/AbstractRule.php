<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

abstract class AbstractRule
{
    protected $config = [
        'message' => '',
        'fields' => []
    ];

    /**
     * AbstractRule constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * @param string $key
     * @param array $data
     *
     * @return bool
     *
     * @throws RuleFailed
     */
    abstract public function process($key, $data);
}
