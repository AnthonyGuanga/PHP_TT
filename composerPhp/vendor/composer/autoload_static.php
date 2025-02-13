<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7549cdcb3ae8088d0846930cbb907d21
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInit7549cdcb3ae8088d0846930cbb907d21::$fallbackDirsPsr4;
            $loader->classMap = ComposerStaticInit7549cdcb3ae8088d0846930cbb907d21::$classMap;

        }, null, ClassLoader::class);
    }
}
