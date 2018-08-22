<?php
namespace Pyrexx\ZUGFeRD\Helper;

use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Class AnnotationRegistryHelper
 */
class AnnotationRegistryHelper
{
    /**
     * @param string $pathToJMSSerializerSrcDir absolute path to the PSR-0 dir of the JMS/Serializer namespace,
     *                                          p.ex. vendor/jms/serializer/src
     */
    public static function registerAutoloadNamespace($pathToJMSSerializerSrcDir)
    {
        AnnotationRegistry::registerAutoloadNamespace('JMS\Serializer\Annotation', $pathToJMSSerializerSrcDir);
    }
}