<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbe1929d6fe1f9b35f802f2e2239637dd
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbe1929d6fe1f9b35f802f2e2239637dd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbe1929d6fe1f9b35f802f2e2239637dd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbe1929d6fe1f9b35f802f2e2239637dd::$classMap;

        }, null, ClassLoader::class);
    }
}
