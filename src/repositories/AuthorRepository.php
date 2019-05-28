<?php

namespace repositories;

use Psr\Log\LoggerInterface;
use repositories\AuthorRepositoryInterface;
use models\Author As AuthorModel;

class AuthorRepository implements AuthorRepositoryInterface {

  protected $db;

  protected $logger;

  public function __construct($db, LoggerInterface $logger) {
    $this->db = $db;
    $this->logger = $logger;
  }

  public function get(int $id): ?AuthorModel {
    $this->logger->debug('AuthorRepository->get', ['id' => $id]);

    $author = $this->db->getConnection()
      ->table('author')
      ->select('id',
        'firstName',
        'lastName')
      ->where('id', $id)
      ->first();

    return $author === null ? null : new AuthorModel((array) $author);
  }

  public function find(int $first, ?int $after, ?string $firstName, ?string $lastName, ?array $orderBy) {
    $this->logger->debug('AuthorRepository->find', ['first' => $first, 'after' => $after, 'firstName' => $firstName, 'lastName' => $lastName, 'orderBy' => $orderBy]);

    $connection = $this->db->getConnection()
      ->table('author')
      ->select('id',
        'firstName',
        'lastName')
      ->limit($first);

    if ($after !== null) { $connection->offset($after); }
    if ($firstName !== null) { $connection->where('firstName', 'like', "%{$firstName}%"); }
    if ($lastName !== null) { $connection->where('lastName', 'like', "{$lastName}%"); }
    if ($orderBy !== null) {
      foreach($orderBy as $ob) {
        $connection->orderBy($ob['field'], $ob['direction']);
      }
    }

    $authors = $connection->get();
    $array = [];

    foreach($authors AS $author) {
      $array[] = new AuthorModel((array) $author);
    }

    return $array;
  }

  public function count(?string $firstName, ?string $lastName): int {
    $this->logger->debug('AuthorRepository->count', ['firstName' => $firstName, 'lastName' => $lastName]);

    $connection = $this->db->getConnection()
      ->table('author');

    if ($firstName !== null) { $connection->where('firstName', 'like', "%{$firstName}%"); }
    if ($lastName !== null) { $connection->where('lastName', 'like', "{$lastName}%"); }

    return $connection->count();
  }

  public function update(int $id, ?string $firstName, ?string $lastName): ?AuthorModel {
    $this->logger->debug('AuthorRepository->update', ['id' => $id, 'firstName' => $firstName, 'lastName' => $lastName]);

  }

  public function create(string $firstName, string $lastName): AuthorModel {
    $this->logger->debug('AuthorRepository->create', ['firstName' => $firstName, 'lastName' => $lastName]);

    $id = $this->db->getConnection()
      ->table('author')
      ->insertGetId([
        'firstName' => $firstName,
        'lastName' => $lastName,
      ]);

    return new AuthorModel(['id' => $id, 'firstName' => $firstName, 'lastName' => $lastName]);

  }

  public function delete(int $id): ?AuthorModel {
    $this->logger->debug('AuthorRepository->update', ['id' => $id]);

  }
}