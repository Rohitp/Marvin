<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit75206abd443efc125fb77e73d55e2f20
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPInsight' => 
            array (
                0 => __DIR__ . '/..' . '/jwhennessey/phpinsight/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit75206abd443efc125fb77e73d55e2f20::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
