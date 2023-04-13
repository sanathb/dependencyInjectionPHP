<?php
class ProductServiceTest extends PHPUnit_Framework_TestCase {
    public function testCreateProduct() {
        $databaseMock = $this->getMockBuilder(DatabaseInterface::class)
                             ->getMock();
        $databaseMock->expects($this->once())
                     ->method('query')
                     ->with($this->equalTo('INSERT INTO products (name, price) VALUES (:name, :price)'), 
                            $this->equalTo([':name' => 'Example Product', ':price' => 9.99]))
                     ->willReturn([]);

        $loggerMock = $this->getMockBuilder(LoggerInterface::class)
                           ->getMock();
        $loggerMock->expects($this->once())
                   ->method('log')
                   ->with($this->equalTo('Product created: Example Product (9.99)'));

        $productService = new ProductService($databaseMock, $loggerMock);
        $productService->createProduct('Example Product', 9.99);
    }
}
