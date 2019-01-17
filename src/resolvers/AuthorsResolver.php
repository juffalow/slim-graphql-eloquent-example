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
    $after = $this->getCursor($args, 'after');
    $firstName = $this->getValue($args, 'firstName');
    $lastName = $this->getValue($args, 'lastName');
    $orderBy = $this->getValue($args, 'orderBy', []);

    $authors = $this->authorRepository->find($first, $after, $firstName, $lastName, $orderBy);
    $totalCount = $this->authorRepository->count($firstName, $lastName);
    $edges = $this->nodesToEdges($authors);

    $endCursor = count($authors) === 0 ? null : base64_encode($authors[count($authors) - 1]->getId());
    $startCursor = count($authors) === 0 ? null : base64_encode($authors[0]->getId());

    return [
      'totalCount' => $totalCount,
      'edges' => $edges,
      'pageInfo' => [
        'endCursor' => $endCursor,
        'hasNextPage' => count($authors) === $first,
        'hasPreviousPage' => $after !== null,
        'startCursor' => $startCursor
      ]
    ];
  }
}