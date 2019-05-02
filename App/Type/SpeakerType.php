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
            // #################################
            // EXERCISE #10
            // ADD SPEAKER TYPE
            // (REMEMBER NAME AND FIELDS)
            // #################################
        ];
        parent::__construct($config);
    }
}
