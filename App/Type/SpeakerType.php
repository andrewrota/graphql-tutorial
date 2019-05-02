<?php

namespace App\Type;

use App\Data\AppContext;
use App\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class SpeakerType
 * @package App\Type
 */
class SpeakerType extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'Speaker',
            'fields' => function () {
                return [
                    'id' => Types::nonNull(Types::int()),
                    'name' => Types::string(),
                    'twitter' => Types::string()
                ];
            },
            'resolveField' => function ($value, $args, $context, ResolveInfo $info) {
                return $value->{$info->fieldName};
            }
        ];
        parent::__construct($config);
    }
}
