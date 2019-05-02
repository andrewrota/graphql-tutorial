<?php
namespace App\Type;

use App\Data\DataSource;
use App\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Mutation',
            'fields' => [
                // #################################
                // EXERCISE #13
                // CREATE FIELD ON MUTATION TYPE
                // TO ADD SPEAKER
                // #################################
            ]
        ];
        parent::__construct($config);
    }
}
