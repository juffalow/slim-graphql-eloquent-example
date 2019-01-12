<?php

namespace repositories;

use models\Author As AuthorModel;

/**
 * 
 * @author Matej 'juffalow' Jellus <juffalow@juffalow.com>
 */
interface AuthorRepositoryInterface {
  /**
   * 
   * @param int $id
   * @return AuthorModel|null
   */
  public function get(int $id): ?AuthorModel;

  /**
   * 
   * @param int $first
   * @param int|null $after
   * @param string|null $firstName
   * @param string|null $lastName
   * @param array|null $orderBy
   */
  public function find(int $first, ?int $after, ?string $firstName, ?string $lastName, ?array $orderBy);

  /**
   * 
   * @param string|null $firstName
   * @param string|null $lastName
   */
  public function count(?string $firstName, ?string $lastName): int;

  /**
   * 
   * @param string $firstName
   * @param string $lastName
   */
  public function create(string $fistName, string $lastName): AuthorModel;

  /**
   * 
   * @param int $id
   * @return AuthorModel|null
   */
  public function delete(int $id): ?AuthorModel;

  /**
   * 
   * @param int @id
   * @param string|null $firstName
   * @param string|null $lastName
   * @return AuthorModel|null
   */
  public function update(int $id, ?string $firstName, ?string $lastName): ?AuthorModel;
}