<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

abstract class AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_MESSAGE';

    /**
     * @var mixed[]
     */
    protected $config = [
        'message' => '',
        'fields' => []
    ];

    /**
     * AbstractRule constructor.
     *
     * @param mixed[] $config
     */
    public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * @param mixed[] $data
     *
     * @throws RuleFailed
     */
    abstract public function process(string $key, array $data): bool;
}
