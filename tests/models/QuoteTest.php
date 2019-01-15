<?php

use PHPUnit\Framework\TestCase;
use models\Quote;

final class QuoteTest extends TestCase {
  public function testConstructor(): void {
    $quote = new Quote([
      'id' => 1,
      'quote' => 'First, solve the problem. Then, write the code.',
      'authorId' => 2
    ]);

    $this->assertEquals(
      1,
      $quote->getId()
    );

    $this->assertEquals(
      'First, solve the problem. Then, write the code.',
      $quote->getQuote()
    );

    $this->assertEquals(
      2,
      $quote->getAuthorId()
    );
  }
}

