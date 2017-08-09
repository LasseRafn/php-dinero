<?php

namespace LasseRafn\Dinero\Utils;

use LasseRafn\Dinero\Builders\Builder;

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
     *
     * @param $pageSize
     *
     * @return $this
     */
    public function perPage($pageSize)
    {
        $this->parameters['pageSize'] = $pageSize;

        return $this;
    }

    /**
     * Add a filter to only show models that are deleted.
     * @return $this
     */
    public function deletedOnly()
    {
        $this->parameters['deletedOnly'] = 'true';

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
     * Build URL parameters
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
     * @return Model[]
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

        while (count($response = $this->builder->get($this->buildParameters())) > 0) {
            foreach ($response as $item) {
                $items[] = $item;
            }

            $this->page($this->parameters['page'] + 1);

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
	 * Returns the set page
	 *
	 * @return integer
	 */
    public function getPage() {
    	return $this->parameters['page'];
    }

	/**
	 * Returns the perPage
	 *
	 * @return integer
	 */
    public function getPerPage() {
    	return $this->parameters['pageSize'];
    }

	/**
	 * Returns the fields
	 *
	 * @return array|null
	 */
    public function getSelectedFields() {
    	return $this->parameters['fields'] ?? null;
    }
}
