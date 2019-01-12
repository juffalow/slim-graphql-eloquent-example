<?php

namespace models;

class Author {
  /**
   * @var int
   */
  protected $id;

  /**
   * @var string
   */
  protected $name;
  
  /**
   * @var string
   */
  protected $lastName;

  public function __construct(array $values) {
    foreach ($values as $key => $value) {
      $this->$key = $value;
    }
  }

  public function getId(): int {
    return $this->id;
  }

  public function getFirstName(): string {
    return $this->firstName;
  }

  public function getLastName(): string {
    return $this->lastName;
  }
}
