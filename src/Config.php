<?php

namespace miladm;

class Config
{
    /**
     * The config values, either from the input object or from the decoded JSON file.
     *
     * @var object
     */
    private object $values;

    /**
     * Cache of previously retrieved values.
     *
     * @var array
     */
    private array $cache = [];

    /**
     * Constructor.
     *
     * @param mixed $input An object, array, or file path string
     */
    public function __construct($input)
    {
        $this->values = is_string($input) && file_exists($input)
            ? json_decode(file_get_contents($input))
            : (object) (is_object($input) || is_array($input) ? $input : []);
    }

    /**
     * Get the value for a given key.
     *
     * @param string $key The key to retrieve the value for
     * @return mixed The value, either from the config values, the environment variable, or the cache
     */
    public function get(string $key): mixed
    {
        return $this->cache[$key] ?? match (true) {
            isset($this->cache[$key]) => $this->cache[$key],
            $value = getenv($key) !== false => $this->cache[$key] = $value,
            property_exists($this->values, $key) => $this->cache[$key] = $this->values->{$key},
            default => null,
        };
    }

    /**
     * Magic method that retrieves the value for an undefined property.
     *
     * @param string $key The key to retrieve the value for
     * @return mixed The value, either from the config values, the environment variable, or the cache
     */
    public function __get($key)
    {
        return $this->get($key);
    }
}
