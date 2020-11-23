<?php namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Models\Book;
use LasseRafn\Dinero\Responses\ListResponse;
use LasseRafn\Dinero\Utils\Request;

class BookingBuilder extends Builder
{
	protected $entity         = 'book';
	protected $model          = Book::class;
	protected $collectionName = 'Book';
	protected $responseClass  = ListResponse::class;

	public function __construct( Request $request, $entity ) {
		$this->entity = $entity;
		parent::__construct( $request );
	}
}
