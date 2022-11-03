<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite7c694b1d8ec43837a62c3c6a27a19cb
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\TaxonomyCaseGuard\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\TaxonomyCaseGuard\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Grav\\Plugin\\TaxonomyCaseGuardPlugin' => __DIR__ . '/../..' . '/taxonomy-case-guard.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite7c694b1d8ec43837a62c3c6a27a19cb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite7c694b1d8ec43837a62c3c6a27a19cb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite7c694b1d8ec43837a62c3c6a27a19cb::$classMap;

        }, null, ClassLoader::class);
    }
}