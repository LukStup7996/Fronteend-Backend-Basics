<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit40885c2039abc38a8da5ae51ebb9bad2
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fhtechnikum\\Uebung34\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fhtechnikum\\Uebung34\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit40885c2039abc38a8da5ae51ebb9bad2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit40885c2039abc38a8da5ae51ebb9bad2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit40885c2039abc38a8da5ae51ebb9bad2::$classMap;

        }, null, ClassLoader::class);
    }
}
