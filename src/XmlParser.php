<?php

namespace liwenyu\yii2;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\RequestParserInterface;

/**
 * Parses a raw HTTP request xml
 *
 * To enable parsing for JSON requests you can configure [[Request::parsers]] using this class:
 *
 * ```php
 * 'request' => [
 *     'parsers' => [
 *         'application/xml' => 'liwenyu\yii2\XmlParser',
 *     ]
 * ]
 * ```
 *
 * @author liwenyu <liwenyu66@gmail.com>
 * @since 1.0.0
 */
class XmlParser implements RequestParserInterface
{
    /**
     * @var boolean whether to return objects in terms of associative arrays.
     */
    public $asArray = true;
    /**
     * @var boolean whether to throw a [[BadRequestHttpException]] if the body is invalid xml
     */
    public $throwException = true;

    /**
     * Parses a HTTP request body.
     * @param string $rawBody the raw HTTP request body.
     * @param string $contentType the content type specified for the request body.
     * @return array parameters parsed from the request body
     * @throws BadRequestHttpException if the body contains invalid xml and [[throwException]] is `true`.
     */
    public function parse($rawBody, $contentType)
    {
        try {
            libxml_use_internal_errors(true);

            $result = simplexml_load_string($rawBody, 'SimpleXMLElement', LIBXML_NOCDATA);
            if ($result === false) {
                return [];
            }

            if (!$this->asArray) {
                return $result;
            }

            return json_decode(json_encode($result), true);
        } catch (InvalidParamException $e) {
            if ($this->throwException) {
                throw new BadRequestHttpException('Invalid Xml data in request body: ' . $e->getMessage());
            }
            return [];
        }
    }
}
