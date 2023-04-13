# Dependency Injection Example in PHP
This is an example of using dependency injection in PHP. 

The code demonstrates how to inject dependencies into a class and how to use interfaces to define those dependencies.
I have put all the interfaces and classes in a single file and not structured into different files to focus only on the design patteen example.

# Usage
To use the code, you will need to create instances of the `MySQLDatabase` and `FileLogger` classes, and then pass those instances to the `ProductService` constructor. 
You can then call the `createProduct()` method on the `ProductService` instance to create a new product in the database.

```php
$database = new MySQLDatabase('localhost', '3306', 'mydatabase', 'myuser', 'mypassword');
$logger = new FileLogger('/var/log/myapp.log');
$productService = new ProductService($database, $logger);

$productService->createProduct('Example Product', 9.99);
```

# Testing
To run the unit tests, you will need to install PHPUnit. Once installed, you can run the tests using the following command:

```php
$ phpunit ProductServiceTest.php
```

The tests will create mock instances of the `DatabaseInterface` and `LoggerInterface` interfaces using PHPUnit's `getMockBuilder()` method. It will then test that the `createProduct()` method on the ProductService class correctly calls the `query()` method on the database instance and the `log()` method on the logger instance.

# License
I, Sanath, give you full permission to use this however you want for the good.
