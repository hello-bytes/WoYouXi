<?php

if (is_file(__DIR__ . '/autoload.php')) {
    require_once __DIR__ . '/autoload.php';
}
if (is_file(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}
require_once __DIR__ . '/Config.php';

use OSS\OssClient;
use OSS\Core\OssException;
use OSS\Core\OssUtil;

/*
 */
class Common
{
    const endpoint = Config::OSS_ENDPOINT;
    const accessKeyId = Config::OSS_ACCESS_ID;
    const accessKeySecret = Config::OSS_ACCESS_KEY;
    const bucket = Config::OSS_TEST_BUCKET;

    /**
     * 根据Config配置，得到一个OssClient实例
     *
     * @return OssClient 一个OssClient实例
     */
    public static function getOssClient()
    {
        try {
            $ossClient = new OssClient(self::accessKeyId, self::accessKeySecret, self::endpoint, false);
        } catch (OssException $e) {
            printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            return null;
        }
        return $ossClient;
    }

    public static function getBucketName(){
        return self::bucket;
    }

    public static function println($message){
        if (!empty($message)) {
            echo strval($message) . "\n";
        }
    }
}
