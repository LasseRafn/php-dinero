<?php

namespace LasseRafn\Dinero\Utils;

use LasseRafn\Dinero\Builders\Builder;
use LasseRafn\Dinero\Responses\PaginatedResponse;

class RequestBuilder
{
    private $builder;

    protected $parameters = [];
    protected $dateFormat = 'Y-m-d';

    public function __construct(Builder $builder)
    {
        $this->parameters['page'] = 0;
        $this->parameters['pageSize'] = 100;

        $this->builder = $builder;
    }

    /**
     * Select only some fields.
     *
     * @param array|int|string $fields
     *
     * @return $this
     */
    public function select($fields)
    {
        if (!isset($this->parameters['fields'])) {
            $this->parameters['fields'] = [];
        }

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->parameters['fields'][] = $field;
            }
        } elseif (is_string($fields) || is_int($fields)) {
            $this->parameters['fields'][] = $fields;
        }

        return $this;
    }

    /**
     * Used for pagination, to set current page.
     * Starts at zero.
     *
     * @param $page
     *
     * @return $this
     */
    public function page($page)
    {
        $this->parameters['page'] = $page;

        return $this;
    }

    /**
     * Used for pagination, to set pagesize.
     * Default: 100, max: 1000.
     *
     * @param $pageSize
     *
     * @return $this
     */
    public function perPage($pageSize)
    {
        if ($pageSize > 1000) {
            $pageSize = 1000;
        }

        $this->parameters['pageSize'] = $pageSize;

        return $this;
    }

    /**
     * Add a filter to only show models that are deleted.
     *
     * @return $this
     */
    public function deletedOnly()
    {
        $this->parameters['deletedOnly'] = 'true';

        return $this;
    }

    /**
     * Remove the filter that only show models that are deleted.
     *
     * @return $this
     */
    public function notDeletedOnly()
    {
        unset($this->parameters['deletedOnly']);

        return $this;
    }

    /**
     * Add a filter to only show models changed since %.
     *
     * @param \DateTime $date
     *
     * @return $this
     */
    public function since(\DateTime $date)
    {
        $this->parameters['changesSince'] = $date->format($this->dateFormat);

        return $this;
    }

    /**
     * Build URL parameters.
     *
     * @return array
     */
    private function buildParameters()
    {
        $parameters = http_build_query($this->parameters);

        if ($parameters !== '') {
            $parameters = "?{$parameters}";
        }

        return $parameters;
    }

    /**
     * Send a request to the API to get models.
     *
     * @return PaginatedResponse
     */
    public function get()
    {
        $response = $this->builder->get($this->buildParameters());

        return $response;
    }

    /**
     * Send a request to the API to get models,
     * manually paginated to get all objects.
     *
     * We specify a minor usleep to prevent some
     * weird bugs. You can disable this if you
     * desire, however I ran into trouble with
     * larger datasets.
     *
     * @param bool $sleep
     *
     * @return array
     */
    public function all($sleep = true)
    {
        $items = [];
        $this->page(0);

        while (count($response = $this->builder->get($this->buildParameters())) > 0) {
            foreach ($response->items as $item) {
                $items[] = $item;
            }

            $this->page($this->getPage() + 1);

            if ($sleep) {
                usleep(200);
            }
        }

        return $items;
    }

    /**
     * Send a request to the API to get a single model.
     *
     * @param $guid
     *
     * @return Model|mixed
     */
    public function find($guid)
    {
        return $this->builder->find($guid);
    }

	/**
	 * Creates a model from a data array.
	 * Sends a API request.
	 *
	 * @param array $data
	 * @param boolean $fakeAttributes
	 *
	 * @return Model
	 */
	public function create($data = [], $fakeAttributes = true)
	{
		return $this->builder->create($data, $fakeAttributes);
	}

    /**
     * Returns the set page.
     *
     * @return int
     */
    public function getPage()
    {
        return $this->parameters['page'];
    }

    /**
     * Returns the perPage.
     *
     * @return int
     */
    public function getPerPage()
    {
        return $this->parameters['pageSize'];
    }

    /**
     * Returns the fields.
     *
     * @return array|null
     */
    public function getSelectedFields()
    {
        return $this->parameters['fields'] ?? null;
    }

    /**
     * Returns deletedOnly state.
     *
     * @return string
     */
    public function getDeletedOnlyState()
    {
        return $this->parameters['deletedOnly'] ?? 'false';
    }

    /**
     * Returns changes since.
     *
     * @return string|null
     */
    public function getSince()
    {
        return $this->parameters['changesSince'] ?? null;
    }

    /**
     * Returns all parameters as an array
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
