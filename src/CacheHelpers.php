<?php

namespace Vink\CacheCard;

class CacheHelpers {
    /**
     * Returns the size of a folder in bytes.
     *
     * @param string $folder
     * @return int
     */
    public static function getFolderSizeInBytes($folder)
    {
        $size = 0;
        foreach (glob(rtrim($folder, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : self::getFolderSizeInBytes($each);
        }
        return $size;
    }

    /**
     * Converts a file size from bytes to a human readable string.
     *
     * @param int $size
     * @return string
     */
    public static function sizeInBytesToReadable($size)
    {
        if ($size < 1024) {
            $size = $size." Bytes";
        } else if ($size < 1048576 && $size > 1023) {
            $size = round($size / 1024, 1) . " KB";
        } else if ($size < 1073741824 && $size > 1048575) {
            $size = round($size / 1048576, 1) . " MB";
        } else {
            $size = round($size / 1073741824, 1) . " GB";
        }

        return $size;
    }

    /**
     * Returns the current size of the local file cache if it is enabled.
     *
     * @return string
     */
    public static function getFileCacheSize()
    {
        $path = config('cache.stores.file.path');

        if (config('cache.default') != 'file') return '';
        if (!file_exists($path)) return '';

        $sizeInBytes = self::getFolderSizeInBytes($path);
        return self::sizeInBytesToReadable($sizeInBytes);
    }
}
