<?php

namespace models;

interface AuthorModelInterface {
  public function getId(): int;

  public function getFirstName(): string;

  public function getLastName(): string;
}
