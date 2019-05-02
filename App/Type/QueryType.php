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
                'speakers' => [
                    'type' => Types::listOf(Types::speaker()),
                    'description' => 'Returns speakers',
                    'resolve' => function() {
                        return DataSource::getSpeakers();
                    }
                ],
                'conferences' => [
                    'type' => Types::listOf(Types::conference()),
                    'description' => 'List conferences',
                    'args' => [
                        'nameFilter' => [
                            'type' => Type::string(),
                            'description' => 'Filter conferences by name (fuzzy search)'
                        ]
                    ],
                    'resolve' => function($root, $args) {
                        if(isset($args['nameFilter'])) {
                            return DataSource::searchConferencesByName($args['nameFilter']);
                        } else {
                            return DataSource::getConferences();
                        }
                    }
                ],
                'getConferenceById' => [
                    'type' => Types::conference(),
                    'description' => 'Returns single conference',
                    'args' => [
                        'id' => [
                            'type' => Type::int(),
                            'description' => 'ID of conference'
                        ]
                    ],
                    'resolve' => function($root, $args) {
                        return DataSource::getConferenceByid($args['id']);
                    }
                ],
            ]
        ];
        parent::__construct($config);
    }
}
