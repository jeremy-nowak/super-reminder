<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit227a63b29d767ca604b9b4bd48547ce3
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit227a63b29d767ca604b9b4bd48547ce3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit227a63b29d767ca604b9b4bd48547ce3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit227a63b29d767ca604b9b4bd48547ce3::$classMap;

        }, null, ClassLoader::class);
    }
}
