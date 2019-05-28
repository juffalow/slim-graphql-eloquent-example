<?php

namespace resolvers;

use resolvers\Resolver;
use repositories\AuthorRepositoryInterface;

/**
 * 
 * @author Matej "juffalow" Jellus <juffalow@juffalow.com>
 */
class AuthorsResolver extends Resolver {

  protected $authorRepository;

  public function __construct(AuthorRepositoryInterface $authorRepository) {
    $this->authorRepository = $authorRepository;
  }

  public function resolve(array $args) {
    $first = $this->getValue($args, 'first', 10);
    $after = $this->getCursor($args, 'after', 0);
    $firstName = $this->getValue($args, 'firstName');
    $lastName = $this->getValue($args, 'lastName');
    $orderBy = $this->getValue($args, 'orderBy', []);

    $authors = $this->authorRepository->find($first, $after, $firstName, $lastName, $orderBy);
    $totalCount = $this->authorRepository->count($firstName, $lastName);
    $edges = $this->nodesToEdges($authors, $after);

    $endCursor = count($edges) === 0 ? null : $edges[count($edges) - 1]['cursor'];
    $startCursor = count($edges) === 0 ? null : $edges[0]['cursor'];

    return [
      'totalCount' => $totalCount,
      'edges' => $edges,
      'pageInfo' => [
        'endCursor' => $endCursor,
        'hasNextPage' => count($authors) === $first,
        'hasPreviousPage' => $after > 0,
        'startCursor' => $startCursor
      ]
    ];
  }
}