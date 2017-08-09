<?php

namespace LasseRafn\Dinero\Utils;

class Model
{
    protected $entity;
    protected $primaryKey;
    protected $modelClass = self::class;
    protected $fillable = [];

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request, $data = [])
    {
        $this->request = $request;

        $data = (array) $data;

        foreach ($data as $attribute => $value) {
            if (!method_exists($this, 'set'.ucfirst(camel_case($attribute)).'Attribute')) {
                $this->setAttribute($attribute, $value);
            } else {
                $this->setAttribute($attribute, $this->{'set'.ucfirst(camel_case($attribute)).'Attribute'}($value));
            }
        }
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

	/**
	 * Returns an array of the models public attributes.
	 *
	 * @return array
	 */
    public function toArray()
    {
        $data = [];
        $properties = ( new \ReflectionObject($this) )->getProperties(\ReflectionProperty::IS_PUBLIC);

        /** @var \ReflectionProperty $property */
        foreach ($properties as $property) {
            $data[$property->getName()] = $property->getValue($property); // todo test this
        }

        return $data;
    }

	/**
	 * Set attribute of model.
	 *
	 * @param $attribute
	 * @param $value
	 */
    protected function setAttribute($attribute, $value)
    {
        $this->{$attribute} = $value;
    }

	/**
	 * Send a request to the API to delete the model.
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
    public function delete()
    {
        return $this->request->curl->delete("/{$this->entity}/{$this->{$this->primaryKey}}");
    }

	/**
	 * Send a request to the API to update the model.
	 *
	 * @param array $data
	 *
	 * @return mixed
	 */
    public function update($data = [])
    {
        $response = $this->request->curl->put("/{$this->entity}/{$this->{$this->primaryKey}}", [
            'json' => $data,
        ]);

        $responseData = json_decode($response->getBody()->getContents());

        return new $this->modelClass($this->request, $responseData);
    }
}
