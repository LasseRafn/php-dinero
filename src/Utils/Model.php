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

    protected function setAttribute($attribute, $value)
    {
        $this->{$attribute} = $value;
    }

    public function delete()
    {
        return $this->request->curl->delete("/{$this->entity}/{$this->{$this->primaryKey}}");
    }

    public function update($data = [])
    {
        $response = $this->request->curl->put("/{$this->entity}/{$this->{$this->primaryKey}}", [
            'json' => $data,
        ]);

        $responseData = json_decode($response->getBody()->getContents());

        return new $this->modelClass($this->request, $responseData);
    }
}
