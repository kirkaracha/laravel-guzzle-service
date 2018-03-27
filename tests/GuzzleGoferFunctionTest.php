<?php declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use Kirkaracha\GuzzleGofer\GuzzleGofer;

class GuzzleGoferFunctionTest
{
    /** @var $mock */
    protected $mock;

    public function __construct()
    {
        $this->mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar']),
            new Response(202, ['Content-Length' => 0]),
            new RequestException("Error Communicating with Server",
            new Request('GET', 'test'))
        ]);

        $handler = HandlerStack::create($this->mock);
        $client = new Client(['handler' => $handler]);
    }

    /**
     * Check that the multiply method returns correct result
     * @return void
     */
    public function testMultiplyReturnsCorrectValue()
    {
        $this->assertSame(GuzzleGofer::multiply(4, 4), 16);
        $this->assertSame(GuzzleGofer::multiply(2, 9), 18);
    }
}
