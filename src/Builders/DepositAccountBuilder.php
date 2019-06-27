<?php

namespace LasseRafn\Dinero\Builders;

use LasseRafn\Dinero\Exceptions\DineroRequestException;
use LasseRafn\Dinero\Exceptions\DineroServerException;
use LasseRafn\Dinero\Models\DepositAccount;

class DepositAccountBuilder extends Builder
{
    protected $entity = 'accounts/deposit';
    protected $model = DepositAccount::class;

    /**
     * @inheritDoc
     */
    public function get($parameters = '')
    {
        try {
            $dineroApiResponse = $this->request->curl->get("{$this->entity}{$parameters}");

            $jsonResponse = json_decode($dineroApiResponse->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new DineroRequestException($exception);
        } catch (ServerException $exception) {
            throw new DineroServerException($exception);
        }

        $request = $this->request;

        $items = array_map(function ($item) use ($request) {
            return new $this->model($request, $item);
        }, $jsonResponse);

        return ['items' => $items];
    }
}
