<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit77ade114d1c3aecc867be1433f05a7d4
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpAmqpLib\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpAmqpLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-amqplib/php-amqplib/PhpAmqpLib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit77ade114d1c3aecc867be1433f05a7d4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit77ade114d1c3aecc867be1433f05a7d4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
