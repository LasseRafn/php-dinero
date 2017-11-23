<?php

namespace LasseRafn\Dinero\Responses;

use GuzzleHttp\Psr7\Response;

Interface ResponseInterface
{
	public function __construct( Response $response, $collectionKey = 'Collection' );

	public function setItems( array $items );
}
