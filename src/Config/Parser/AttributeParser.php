<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Config\Parser;

use Overblog\GraphQLBundle\Config\Parser\MetadataParser\MetadataParser;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use Reflector;

class AttributeParser extends MetadataParser
{
    const METADATA_FORMAT = '#[%s]';

    public static function getMetadatas(Reflector $reflector): array
    {
        $attributes = [];

        switch (true) {
            case $reflector instanceof ReflectionClass:
            case $reflector instanceof ReflectionMethod:
            case $reflector instanceof ReflectionProperty:
                $attributes = $reflector->getAttributes();
        }

        // @phpstan-ignore-line
        return array_map(fn (ReflectionAttribute $attribute) => $attribute->newInstance(), $attributes);
    }
}
