<?php declare(strict_types=1);

use Kirkaracha\GuzzleGofer\GuzzleGofer;

class GuzzleGoferFunctionTest
{
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
