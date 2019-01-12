<?php

namespace repositories;

use Psr\Log\LoggerInterface;
use repositories\QuoteRepositoryInterface;
use models\Quote As QuoteModel;

class QuoteRepository implements QuoteRepositoryInterface {

  protected $db;

  protected $logger;

  public function __construct($db, LoggerInterface $logger) {
    $this->db = $db;
    $this->logger = $logger;
  }

  public function get(int $id): ?QuoteModel {
    $this->logger->debug('QuoteRepository->get', ['id' => $id]);

    $quote = $this->db->getConnection()
      ->table('quote')
      ->select('id',
        'author_id AS authorId',
        'quote')
      ->where('id', $id)
      ->first();

    return $quote === null ? null : new QuoteModel((array) $quote);
  }

  public function find(int $first, ?int $after, ?string $quote, ?array $orderBy) {
    $this->logger->debug('QuoteRepository->find', ['first' => $first, 'after' => $after, 'quote' => $quote, 'orderBy' => $orderBy]);

    $connection = $this->db->getConnection()
      ->table('quote')
      ->select('id',
        'author_id AS authorId',
        'quote')
      ->limit($first);

    if ($after !== null) { $connection->where('id', '>', $after); }
    if ($quote !== null) { $connection->where('quote', 'like', "%{$quote}%"); }
    if ($orderBy !== null) {
      foreach($orderBy as $ob) {
        $connection->orderBy($ob['field'], $ob['direction']);
      }
    }

    $quotes = $connection->get();
    $array = [];

    foreach($quotes AS $quote) {
      $array[] = new QuoteModel((array) $quote);
    }

    return $array;
  }

  public function count(?string $quote): int {
    $this->logger->debug('QuoteRepository->count', ['quote' => $quote]);

    $connection = $this->db->getConnection()
      ->table('quote');

    if ($quote !== null) { $connection->where('quote', 'like', "%{$quote}%"); }

    return $connection->count();
  }

  public function create(int $authorId, string $quote): QuoteModel {
    $this->logger->debug('QuoteRepository->create', ['authorId' => $authorId, 'quote' => $quote]);
  }

  public function delete(int $id): ?QuteModel {
    $this->logger->debug('QuoteRepository->delete', ['id' => $id]);
  }

  public function update(int $id, ?string $quote): ?QuoteModel {
    $this->logger->debug('QuoteRepository->update', ['id' => $id, 'quote' => $quote]);
  }
}