<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2436e4e9e9d46c77b0b1045592788a20
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2436e4e9e9d46c77b0b1045592788a20::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2436e4e9e9d46c77b0b1045592788a20::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2436e4e9e9d46c77b0b1045592788a20::$classMap;

        }, null, ClassLoader::class);
    }
}
