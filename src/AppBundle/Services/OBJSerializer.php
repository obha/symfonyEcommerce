<?php

namespace AppBundle\Services;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class OBJSerializer 
{

    public static function serialize(Object $obj, $encoder = 'json')
    {
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $normalizers = array($normalizer);
        $encoders = array('json' => new JsonEncoder());

        $serializer = new Serializer($normalizers,$encoders);
        return $serializer->serialize($obj, $encoder);
    }
}
