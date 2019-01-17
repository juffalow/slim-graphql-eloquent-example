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
    $after = $this->getCursor($args, 'after');
    $quote = $this->getValue($args, 'quote');
    $orderBy = $this->getValue($args, 'orderBy', []);

    $quotes = $this->quoteRepository->find($first, $after, $quote, $orderBy);
    $totalCount = $this->quoteRepository->count($quote);
    $edges = $this->nodesToEdges($quotes);

    $endCursor = count($quotes) === 0 ? null : base64_encode($quotes[count($quotes) - 1]->getId());
    $startCursor = count($quotes) === 0 ? null : base64_encode($quotes[0]->getId());

    return [
      'totalCount' => $totalCount,
      'edges' => $edges,
      'pageInfo' => [
        'endCursor' => $endCursor,
        'hasNextPage' => count($quotes) === $first,
        'hasPreviousPage' => $after !== null,
        'startCursor' => $startCursor
      ]
    ];
  }
}