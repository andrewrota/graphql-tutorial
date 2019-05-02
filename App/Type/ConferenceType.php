<?php
namespace App\Type;

use App\Data\AppContext;
use App\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Deferred;
use App;
use App\SpeakerCollection;
use GraphQL\Type\Definition\ResolveInfo;
use App\Data\DataSource;



/**
 * Class ConferenceType
 * @package App\Type
 */
class ConferenceType extends ObjectType
{

    private $speakers = [];

    public function __construct()
    {
        $config = [
            'name' => 'Conference',
            'fields' => [
                    'id' => Type::nonNull(Types::int()),
                    'name' => Type::nonNull(Types::string()),
                    'url' => Type::nonNull(Types::string()),
                    'description' => Types::string(),
                    'location' => Types::string(),
                    'dates' => Type::nonNull(Types::string()),
                ],
            'resolveField' => function($value, $args, $context, $info) {
                return $value->{$info->fieldName};
            }
        ];
        parent::__construct($config);
    }
}
