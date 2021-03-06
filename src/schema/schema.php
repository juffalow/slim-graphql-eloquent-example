<?php

use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;

use queries\Author as AuthorQuery;
use queries\Authors as AuthorsQuery;
use queries\Quote as QuoteQuery;
use queries\Quotes as QuotesQuery;

use mutations\CreateAuthor as CreateAuthorMutation;

return new Schema([
  'query' => new ObjectType([
    'name' => 'Query',
    'fields' => [
      'author' => AuthorQuery::get(),
      'authors' => AuthorsQuery::get(),
      'quote' => QuoteQuery::get(),
      'quotes' => QuotesQuery::get(),
    ]
  ]),
  'mutation' => new ObjectType([
    'name' => 'Mutation',
    'fields' => [
        'createAuthor' => CreateAuthorMutation::get(),
    ]
])
]);
