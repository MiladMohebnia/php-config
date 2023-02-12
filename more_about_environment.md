# Using environment variables

You can also retrieve configuration values from environment variables. If an environment variable is defined with the same name as a configuration key, the `get()` method will return the value of the environment variable instead of the value from the configuration data.

## Using Docker

If you are using Docker to run your PHP application, you can pass environment variables to the container using the `-e` option with the `docker run` command. For example:

```
docker run -e DB_HOST=localhost -e DB_PORT=3306 -e DB_USER=myuser -e DB_PASS=mypass -e DB_NAME=mydb myapp
```

This will set the environment variables `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, and `DB_NAME` to the specified values in the container.

## Using the terminal

You can also set environment variables using the terminal. On Unix-based systems, you can use the `export` command to set environment variables. For example:

```
export DB_HOST=localhost
export DB_PORT=3306
export DB_USER=myuser
export DB_PASS=mypass
export DB_NAME=mydb
```


On Windows, you can use the `set` command to set environment variables. For example:

```
set DB_HOST=localhost
set DB_PORT=3306
set DB_USER=myuser
set DB_PASS=mypass
set DB_NAME=mydb
```


## Using a .env file

Another way to set environment variables is by using a `.env` file in your project root directory. A `.env` file is a simple text file with one key-value pair per line, in the format `KEY=value`. For example:

```
DB_HOST=localhost
DB_PORT=3306
DB_USER=myuser
DB_PASS=mypass
DB_NAME=mydb
```
To load environment variables from a `.env` file, you can use a library like `vlucas/phpdotenv`. To install `phpdotenv` using Composer, run:

```
composer require vlucas/phpdotenv
```

You can then load the environment variables from the `.env` file using the `load()` method:

```php
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
```
This will load the environment variables from the .env file into the current environment.

## Updating configuration values
If you need to update a configuration value at runtime, you can do so by setting the corresponding property in the $values object. For example:
```php
$config->values->db_host = 'newhost';

```

This will update the value of the db_host key to 'newhost'. Note that this will not affect the value of the environment variable or the internal cache, so you may need to clear the cache manually if you want to fetch the updated value again using the get() method.