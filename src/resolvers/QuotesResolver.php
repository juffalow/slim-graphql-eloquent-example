<?php

namespace resolvers;

use resolvers\Resolver;

/**
 * 
 * @author Matej "juffalow" Jellus <juffalow@juffalow.com>
 */
class QuotesResolver extends Resolver {

  public function __construct(object $context, object $resolveInfo) {
    parent::__construct($context, $resolveInfo);
  }

  public function resolve(array $args) {
    $first = $this->getValue($args, 'first', 10);
    $after = $this->getCursor($args, 'after');
    $quote = $this->getValue($args, 'quote');
    $orderBy = $this->getValue($args, 'orderBy', []);

    $quotes = $this->context->repository->quote->find($first, $after, $quote, $orderBy);
    $totalCount = $this->context->repository->quote->count($quote);
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