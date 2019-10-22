<?php

use PHPUnit\Framework\TestCase;
use GraphQL\Error\ClientAware;
use errors\NotFound;

final class NotFoundTest extends TestCase {
  public function testIfIsClientAware(): void {
    $notFound = new NotFound();

    $this->assertTrue($notFound instanceof ClientAware);

    $this->assertTrue($notFound instanceof \Exception);

    $this->assertTrue($notFound->isClientSafe());
  }

  public function testCategory(): void {
    $notFound = new NotFound();

    $this->assertEquals(
      'General',
      $notFound->getCategory()
    );
  }
}

