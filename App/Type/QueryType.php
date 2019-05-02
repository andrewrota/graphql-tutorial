<?php
namespace App\Type;

use App\Data\DataSource;
use App\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'fields' => [
                // #################################
                // EXERCISE #8
                // ADD CONFERENCE FIELDS:
                // 'conferences' and 'getConferenceById'
                // #################################
            ]
        ];
        parent::__construct($config);
    }
}
