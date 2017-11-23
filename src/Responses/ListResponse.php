<?php

namespace LasseRafn\Dinero\Responses;

use GuzzleHttp\Psr7\Response;

class ListResponse implements ResponseInterface
{
	/** @var array */
	public $items;

	public $page;
	public $pageSize;
	public $maxPageSizeAllowed;

	public $result;
	public $resultWithoutFilter;

	public function __construct( Response $response, $collectionKey = 'Collection' ) {
		$jsonResponse = json_decode( $response->getBody()->getContents() );

		$this->items = $jsonResponse->{$collectionKey};
	}

	public function setItems( array $items ) {
		$this->items = $items;

		return $this;
	}
}
