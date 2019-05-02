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
                'addSpeaker' => [
                    'type' => Types::listOf(Types::speaker()),
                    'args' => [
                        'name' => Type::nonNull(Type::string()),
                        'twitter' => Type::string()
                    ],
                    'type' => new ObjectType([
                        'name' => 'CreateSpeakerOutput',
                        'fields' => [
                            'id' => ['type' => Type::int()]
                        ]
                    ]),
                    'description' => 'Adds a new conference',
                    'resolve' => function ($root, $args) {
                        return DataSource::addSpeaker($args['name'], isset($args['twitter']) ? $args['twitter'] : null);
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}
