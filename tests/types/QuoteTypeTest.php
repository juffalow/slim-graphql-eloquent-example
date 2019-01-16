<?php

use PHPUnit\Framework\TestCase;
use types\Quote as QuoteType;
use models\Quote;

final class QuoteTypeTest extends TestCase {
  public function testFieldResolveFunctions(): void {
    $quoteType = QuoteType::get();
    $quoteModel = new Quote(['id' => 1, 'quote' => 'Talk is cheap. Show me the code.']);

    $resolveIdFn = $quoteType->getField('_id')->resolveFn;
    $resolveQuoteFn = $quoteType->getField('quote')->resolveFn;
    
    $this->assertEquals(
      1,
      $resolveIdFn($quoteModel)
    );

    $this->assertEquals(
      'Talk is cheap. Show me the code.',
      $resolveQuoteFn($quoteModel)
    );
  }
}

