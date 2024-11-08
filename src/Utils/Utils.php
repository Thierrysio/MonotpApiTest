<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class Utils
{
    public function GetJsonResponse(Request $request, $var, $ignoredFields = [])
    {
        $encoder = new JsonEncoder();
        $defaultContext = [
                    AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                        return $object->getId();
                    },
                ];

                $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
                $dateNormalizer = new DateTimeNormalizer(array('datetime_format' => 'Y-m-d H:i:s'));

        $serializer = new Serializer([$dateNormalizer, $normalizer], [$encoder]);
        $data = $request->getContent();
        
        array_push($ignoredFields, '__initializer__', '__cloner__', '__isInitialized__'); // Permet d'enlever des champs inutiles
        $data = $serializer->serialize($var, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => $ignoredFields]);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');


        return $response;
    }

    public static function ErrorMissingArguments()
    {
        $response = new Response('MISSING_ARGUMENTS_PARAMETERS', 400);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }
    public static function  ErrorMissingArgumentsDebug($content){
        $response = new Response('MISSING_ARGUMENTS_PARAMETERS content :'.$content);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }
    public static function ErrorCustom($message)
    {
        $response = new Response($message, 400);
        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }
}