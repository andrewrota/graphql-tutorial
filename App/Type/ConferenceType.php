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
            // #################################
            // EXERCISE #7
            // ADD CONFERENCE TYPE:
            // (DEFINE NAME AND FIELDS WITH TYPES)
            // #################################
        ];
        parent::__construct($config);
    }
}
