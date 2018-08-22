<?php
namespace Pyrexx\ZUGFeRD\Helper;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Class AnnotationRegistryHelper
 */
class AnnotationRegistryHelper
{
    /**
     * Register autoload namespace for JMS Serializer in Doctrine Annotations
     */
    public static function registerAutoloadNamespace()
    {

        static $already_called = false;

        if ($already_called) {
            return;
        }
        $already_called = true;

        try {
            $reflection_class = new \ReflectionClass(XmlRoot::class);
        } catch (\ReflectionException $e) {
            throw new \RuntimeException('JMS Serializer was not found');
        }

        // remove the part after /src from the path
        $pattern_to_remove = '#' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, ['JMS','Serializer','Annotation','XmlRoot.php']) . '$#';
        $jsm_dir = preg_replace($pattern_to_remove, '', $reflection_class->getFileName());

        AnnotationRegistry::registerAutoloadNamespace('JMS\Serializer\Annotation', $jsm_dir);
    }
}