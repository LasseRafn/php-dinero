<?php namespace LasseRafn\Dinero\Models;

use LasseRafn\Dinero\Utils\Model;

class Book extends Model
{
    protected $entity     = 'book';
    protected $primaryKey = 'Guid';

    public $Guid;
    public $Number;
    public $Timestamp;
}
