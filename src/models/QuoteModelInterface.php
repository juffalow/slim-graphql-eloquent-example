<?php

namespace models;

interface QuoteModelInterface {
  public function getId(): int;

  public function getQuote(): string;

  public function getAuthorId(): int;
}
