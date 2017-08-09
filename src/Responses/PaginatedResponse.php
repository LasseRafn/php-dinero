<?php

namespace LasseRafn\Dinero\Responses;

use Guzzle\Http\Message\Response;

class PaginatedResponse
{
	/** @var array */
	public $items;

	public $page;
	public $pageSize;
	public $maxPageSizeAllowed;

	public $result;
	public $resultWithoutFilter;

	public function __construct( Response $response )
	{
		$this->items = $response->json()->Collection;

		$this->page                = $response->json()->Pagination->Page;
		$this->pageSize            = $response->json()->Pagination->PageSize;
		$this->maxPageSizeAllowed  = $response->json()->Pagination->MaxPageSizeAllowed;
		$this->result              = $response->json()->Pagination->Result;
		$this->resultWithoutFilter = $response->json()->Pagination->ResultWithoutFilter;
	}

	public function setItems(array $items) {
		$this->items = $items;

		return $this;
	}
}