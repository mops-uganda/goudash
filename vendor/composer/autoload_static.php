<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite5d541afa7e2790eb709569d41354118
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SmartUI\\' => 8,
        ),
        'C' => 
        array (
            'Common\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SmartUI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/smartui',
        ),
        'Common\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/common',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/app',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite5d541afa7e2790eb709569d41354118::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite5d541afa7e2790eb709569d41354118::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite5d541afa7e2790eb709569d41354118::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
