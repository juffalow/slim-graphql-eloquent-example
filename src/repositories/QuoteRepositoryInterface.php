<?php

namespace repositories;

use models\Quote As QuoteModel;

/**
 *
 * @author Matej 'juffalow' Jellus <juffalow@juffalow.com>
 */
interface QuoteRepositoryInterface {
  /**
   *
   * @param int $id
   * @return QuoteModel
   * @throws Exception
   */
  public function get(int $id): QuoteModel;

  /**
   *
   * @param int $first
   * @param int|null $after
   * @param string|null $quote
   * @param array|null $orderBy
   */
  public function find(int $first, ?int $after, ?string $quote, ?array $orderBy);

  /**
   *
   * @param string|null $quote
   */
  public function count(?string $quote): int;

  /**
   *
   * @param int $authorId
   * @param string $quote
   */
  public function create(int $authorId, string $quote): QuoteModel;

  /**
   *
   * @param int $id
   * @return QuoteModel|null
   */
  public function delete(int $id): ?QuoteModel;

  /**
   *
   * @param int @id
   * @param string|null $quote
   * @return QuoteModel|null
   */
  public function update(int $id, ?string $quote): ?QuoteModel;
}