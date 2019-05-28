<?php

namespace resolvers;

use resolvers\Resolver;
use repositories\QuoteRepositoryInterface;

/**
 * 
 * @author Matej "juffalow" Jellus <juffalow@juffalow.com>
 */
class QuotesResolver extends Resolver {

  protected $quoteRepository;

  public function __construct(QuoteRepositoryInterface $quoteRepository) {
    $this->quoteRepository = $quoteRepository;
  }

  public function resolve(array $args) {
    $first = $this->getValue($args, 'first', 10);
    $after = $this->getCursor($args, 'after', 0);
    $quote = $this->getValue($args, 'quote');
    $orderBy = $this->getValue($args, 'orderBy', []);

    $quotes = $this->quoteRepository->find($first, $after, $quote, $orderBy);
    $totalCount = $this->quoteRepository->count($quote);
    $edges = $this->nodesToEdges($quotes, $after);

    $endCursor = count($edges) === 0 ? null : $edges[count($edges) - 1]['cursor'];
    $startCursor = count($edges) === 0 ? null : $edges[0]['cursor'];

    return [
      'totalCount' => $totalCount,
      'edges' => $edges,
      'pageInfo' => [
        'endCursor' => $endCursor,
        'hasNextPage' => count($quotes) === $first,
        'hasPreviousPage' => $after > null,
        'startCursor' => $startCursor
      ]
    ];
  }
}