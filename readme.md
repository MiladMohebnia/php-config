# Config class

The `Config` class provides a simple way to manage configuration settings for your PHP application. You can initialize the `Config` object with an object, array, or file path containing your configuration data, and then retrieve individual configuration values using the `get()` method.

## Basic usage

To get started with the `Config` class, create a new instance of the class by passing in your configuration data:

```php
use miladm\Config;

$config = new Config([
    'db_host' => 'localhost',
    'db_port' => 3306,
    'db_user' => 'myuser',
    'db_pass' => 'mypass',
    'db_name' => 'mydb',
]);
```
You can then retrieve individual configuration values using the get() method:

```php
$host = $config->get('db_host');
$port = $config->get('db_port');
$user = $config->get('db_user');
$pass = $config->get('db_pass');
$name = $config->get('db_name');
```
If a configuration value is not found, the get() method will return null.

## Using environment variables
You can also retrieve configuration values from environment variables. If an environment variable is defined with the same name as a configuration key, the get() method will return the value of the environment variable instead of the value from the configuration data. For example:

```php
putenv('DB_HOST=localhost');
putenv('DB_PORT=3306');
putenv('DB_USER=myuser');
putenv('DB_PASS=mypass');
putenv('DB_NAME=mydb');

$host = $config->get('db_host'); // returns 'localhost'
$port = $config->get('db_port'); // returns 3306
$user = $config->get('db_user'); // returns 'myuser'
$pass = $config->get('db_pass'); // returns 'mypass'
$name = $config->get('db_name'); // returns 'mydb'
```
[more about environemt variables in different environments](more_about_environment.md)

## Magic properties
The Config class also supports retrieving configuration values using magic properties. If a property with the same name as a configuration key is accessed, the __get() magic method will be called, which is equivalent to calling the get() method. For example:

```php
$host = $config->db_host;
$port = $config->db_port;
$user = $config->db_user;
$pass = $config->db_pass;
$name = $config->db_name;
```
## Caching
To improve performance, the Config class caches retrieved values in an internal array. This means that subsequent calls to get() for the same configuration key will return the cached value instead of re-fetching it from the configuration data or environment variables. If you need to clear the cache for a particular key, you can do so by setting the corresponding value in the internal cache array to null. For example:

```php
$config->get('db_host'); // fetches from configuration data or environment variables and caches the value
$config->cache['db_host'] = null; // clears the cache for the 'db_host' key
$config->get('db_host'); // fetches from configuration data or 
```
environment variables again and caches the value

## Error handling
If your configuration data is not valid, the Config constructor will throw an exception. For example, if you pass in a string that is not a valid file path or JSON string, or an object or array with non-string keys, an exception will be thrown with an appropriate