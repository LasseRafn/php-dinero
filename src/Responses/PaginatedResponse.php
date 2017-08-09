<?php

namespace LasseRafn\Dinero\Responses;

use GuzzleHttp\Psr7\Response;

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
		$jsonResponse = json_decode($response->getBody()->getContents());

		$this->items = $jsonResponse->Collection;

		$this->page                = $jsonResponse->Pagination->Page;
		$this->pageSize            = $jsonResponse->Pagination->PageSize;
		$this->maxPageSizeAllowed  = $jsonResponse->Pagination->MaxPageSizeAllowed;
		$this->result              = $jsonResponse->Pagination->Result;
		$this->resultWithoutFilter = $jsonResponse->Pagination->ResultWithoutFilter;
	}

	public function setItems(array $items) {
		$this->items = $items;

		return $this;
	}
}