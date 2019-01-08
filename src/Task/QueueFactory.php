<?php

namespace SwooleTW\Http\Task;

use Illuminate\Contracts\Queue\Queue;
use Illuminate\Support\Arr;
use SwooleTW\Http\Helpers\FW;

/**
 * Class QueueFactory
 */
class QueueFactory
{
    /**
     * Version with breaking changes
     *
     * @const string
     */
    public const CHANGE_VERSION = '5.7';

    /**
     * @param \Swoole\Http\Server $server
     * @param string $version
     *
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public static function make($server, string $version): Queue
    {
//        $isMatch = static::isFileVersionMatch($version);
//        $class =
//        $class = static::copy(static::stub($version), ! $isMatch);
        $class = static::hasBreakingChanges($version)
            ? '\SwooleTW\Http\Task\Queue\V5_7\SwooleTaskQueue'
            : '\SwooleTW\Http\Task\Queue\V5_6\SwooleTaskQueue';

        return new $class($server);
    }

    /**
     * @param string $version
     *
     * @return string
     */
    public static function stub(string $version): string
    {
        return static::getClass($version);
    }

    public static function getClass($version): string
    {
        return static::hasBreakingChanges($version)
            ? '\SwooleTW\Http\Task\Queue\V5_7\SwooleTaskQueue'
            : '\SwooleTW\Http\Task\Queue\V5_6\SwooleTaskQueue';
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    protected static function hasBreakingChanges(string $version): bool
    {
        return version_compare($version, self::CHANGE_VERSION, '>=');
    }
}
