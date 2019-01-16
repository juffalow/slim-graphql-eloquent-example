<?php

use PHPUnit\Framework\TestCase;
use types\Quote as QuoteType;
use models\Quote;

final class QuoteTypeTest extends TestCase {
  public function testFieldResolveFunctions(): void {
    $quoteType = QuoteType::get();
    $quoteModel = new Quote(['id' => 1, 'quote' => 'Talk is cheap. Show me the code.']);

    $resolveUniqueIdFn = $quoteType->getField('id')->resolveFn;
    $resolveIdFn = $quoteType->getField('_id')->resolveFn;
    $resolveQuoteFn = $quoteType->getField('quote')->resolveFn;
    
    $this->assertEquals(
      base64_encode('quote1'),
      $resolveUniqueIdFn($quoteModel)
    );

    $this->assertEquals(
      1,
      $resolveIdFn($quoteModel)
    );

    $this->assertEquals(
      'Talk is cheap. Show me the code.',
      $resolveQuoteFn($quoteModel)
    );
  }

  public function testFieldNames(): void {
    $quoteType = QuoteType::get();

    $this->assertEquals(
      'id',
      $quoteType->getField('id')->name
    );

    $this->assertEquals(
      '_id',
      $quoteType->getField('_id')->name
    );


    $this->assertEquals(
      'quote',
      $quoteType->getField('quote')->name
    );

    $this->assertEquals(
      'author',
      $quoteType->getField('author')->name
    );
  }

  public function testFieldDescriptions(): void {
    $quoteType = QuoteType::get();

    $this->assertGreaterThan(
      0,
      strlen($quoteType->getField('id')->description)
    );

    $this->assertGreaterThan(
      0,
      strlen($quoteType->getField('_id')->description)
    );


    $this->assertGreaterThan(
      0,
      strlen($quoteType->getField('quote')->description)
    );

    $this->assertGreaterThan(
      0,
      strlen($quoteType->getField('author')->description)
    );
  }
}

