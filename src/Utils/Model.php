<?php

namespace LasseRafn\Dinero\Utils;

class Model
{
    protected $entity;
    protected $primaryKey;
    protected $modelClass = self::class;
    protected $fillable = [];
    protected $request;

    public function __construct(Request $request, $data = [])
    {
        $this->request = $request;

        $data = (array) $data;

        foreach ($data as $attribute => $value) {
            if (!method_exists($this, 'set'.ucfirst($this->camelCase($attribute)).'Attribute')) {
                $this->setAttribute($attribute, $value);
            } else {
                $this->setAttribute($attribute, $this->{'set'.ucfirst($this->camelCase($attribute)).'Attribute'}($value));
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
        $class = new \ReflectionObject($this);
        $properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC);

        /** @var \ReflectionProperty $property */
        foreach ($properties as $property) {
            $data[$property->getName()] = $this->{$property->getName()};
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

    /**
     * Convert a string to camelCase.
     *
     * @param $string
     *
     * @return mixed
     */
    private function camelCase($string)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $string));
        $value = str_replace(' ', '', $value);

        return lcfirst($value);
    }
}
