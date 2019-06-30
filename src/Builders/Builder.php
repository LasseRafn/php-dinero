<?php

namespace LasseRafn\Dinero\Builders;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use LasseRafn\Dinero\Exceptions\DineroRequestException;
use LasseRafn\Dinero\Exceptions\DineroServerException;
use LasseRafn\Dinero\Responses\PaginatedResponse;
use LasseRafn\Dinero\Responses\ResponseInterface;
use LasseRafn\Dinero\Utils\Model;
use LasseRafn\Dinero\Utils\Request;

class Builder
{
    protected $request;
	protected $entity;
	protected $responseClass  = PaginatedResponse::class;

	/** @var Model */
	protected $model;

	public function __construct( Request $request ) {
		$this->request = $request;
	}

	/**
	 * @param $id
	 *
	 * @return mixed|Model
	 */
	public function find( $id ) {
		try {
			$response     = $this->request->curl->get( "{$this->entity}/{$id}" );
			$responseData = json_decode( $response->getBody()->getContents() );

			return new $this->model( $this->request, $responseData );
		} catch ( ClientException $exception ) {
			throw new DineroRequestException( $exception );
		} catch ( ServerException $exception ) {
			throw new DineroServerException( $exception );
		}
	}

	/**
	 * @param string $parameters
	 *
	 * @return ResponseInterface
	 */
	public function get( $parameters = '' ) {
		try {
			$dineroApiResponse          = $this->request->curl->get( "{$this->entity}{$parameters}" );
			$response = new $this->responseClass( $dineroApiResponse, $this->getCollectionName() );
		} catch ( ClientException $exception ) {
			throw new DineroRequestException( $exception );
		} catch ( ServerException $exception ) {
			throw new DineroServerException( $exception );
		}

		$request = $this->request;

		$response->setItems( array_map( function ( $item ) use ( $request ) {
			return new $this->model( $request, $item );
		}, $response->items ) );

		return $response;
	}

	/**
	 * Creates a model from a data array.
	 * Sends a API request.
	 *
	 * @param array $data
	 * @param bool  $fakeAttributes
	 *
	 * @throws DineroRequestException
	 * @throws DineroServerException
	 *
	 * @return Model
	 */
	public function create( $data = [], $fakeAttributes = true ) {
		try {
			$response = $this->request->curl->post( "{$this->getEntity()}", [
				'json' => $data,
			] );

			$responseData = (array) json_decode( $response->getBody()->getContents() );

			if ( ! $fakeAttributes ) {
				$freshData = (array) $this->find( $responseData[ ( new $this->model( $this->request ) )->getPrimaryKey() ] );
			}

			$mergedData = array_merge( $responseData, $fakeAttributes ? $data : $freshData );

			return new $this->model( $this->request, $mergedData );
		} catch ( ClientException $exception ) {
			throw new DineroRequestException( $exception );
		} catch ( ServerException $exception ) {
			throw new DineroServerException( $exception );
		}
	}

	public function getEntity() {
		return $this->entity;
	}

	public function getCollectionName() {
		return isset( $this->collectionName ) ? $this->collectionName : 'Collection';
	}
}
