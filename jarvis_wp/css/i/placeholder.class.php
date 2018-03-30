<?php
if (strpos(__FILE__, $_SERVER['PHP_SELF'])) { header('HTTP/1.0 403 Forbidden'); exit; }
/**
 * Creates temporary placeholder images
 *
 * @package Placeholder
 * @version 1.1.1
 * @link http://github.com/img-src/placeholder
 */
class Placeholder {
    
    private $backgroundColor, $cache, $cacheDir, $expires, $height, $maxHeight, $maxWidth, $width;

    function __construct()
    {
        $this->backgroundColor = 'ffffff';
        $this->cache           = false;
        $this->cacheDir        = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cache';
        $this->expires         = 604800;
        $this->maxHeight       = 2000;
        $this->maxWidth        = 2000;
    }

    /**
     * Sets background color
     *
     * @param string $hex Hex code value
     * @throws InvalidArgumentException
     */
    function setBackgroundColor($hex)
    {
        if (strlen($hex) === 3 || strlen($hex) === 6) {
            if (preg_match('/^[a-f0-9]{3}$|^[a-f0-9]{6}$/i', $hex)) {
                $this->backgroundColor = $hex;
            } else {
                throw new InvalidArgumentException('Background color must be a valid RGB hex code.');
            }
        } else {
            throw new InvalidArgumentException('Background color must be 3 or 6 character hex code.');
        }
    }

    /**
     * Gets background color
     */
    function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set expires header value
     * 
     * @param int $expires Seconds used in expires HTTP header
     * @throws InvalidArgumentException
     */
    function setExpires($expires)
    {
        if (preg_match('/^\d+$/', $expires)) {
            $this->expires = $expires;
        } else {
            throw new InvalidArgumentException('Expires must be an integer.');
        }
    }

    /**
     * Get expires header value
     */
    function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set maximum width allowed for placeholder image
     * 
     * @param int $maxWidth Maximum width of generated image
     * @throws InvalidArgumentException
     */
    function setMaxWidth($maxWidth)
    {
        if (preg_match('/^\d+$/', $maxWidth)) {
            $this->maxWidth = $maxWidth;
        } else {
            throw new InvalidArgumentException('Maximum width must be an integer.');
        }
    }

    /**
     * Get max width value
     */
    function getMaxWidth()
    {
        return $this->maxWidth;
    }

    /**
     * Set maximum height allowed for placeholder image
     * 
     * @param int $maxHeight Maximum height of generated image
     * @throws InvalidArgumentException
     */
    function setMaxHeight($maxHeight)
    {
        if (preg_match('/^\d+$/', $maxHeight)) {
            $this->maxHeight = $maxHeight;
        } else {
            throw new InvalidArgumentException('Maximum height must be an integer.');
        }
    }

    /**
     * Get max height value
     */
    function getMaxHeight()
    {
        return $this->maxHeight;
    }

    /**
     * Enable or disable cache
     * 
     * @param bool $cache Whether or not to cache
     * @throws InvalidArgumentException
     */
    function setCache($cache)
    {
        if (is_bool($cache)) {
            $this->cache = $cache;
        } else {
            throw new InvalidArgumentException('setCache expects a boolean value.');
        }
    }

    /**
     * Get cache value
     */
    function getCache()
    {
        return $this->cache;
    }

    /**
     * Sets caching path
     * 
     * @param string $cacheDir Path to cache folder, must be writable by web server
     * @throws InvalidArgumentException
     */
    function setCacheDir($cacheDir)
    {
        if (is_dir($cacheDir)) {
            $this->cacheDir = $cacheDir;
        } else {
            throw new InvalidArgumentException('setCacheDir expects a directory.');
        }
    }

    /**
     * Get cache directory value
     */
    function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * Set width of image to render
     * 
     * @param int $width Width of generated image
     * @throws InvalidArgumentException
     */
    function setWidth($width)
    {
        if (preg_match('/^\d+$/', $width)) {
            if ($width > 0) {
                $this->width = $width;
            } else {
                throw new InvalidArgumentException('Width must be greater than zero.');
            }
        } else {
            throw new InvalidArgumentException('Width must be an integer.');
        }
    }

    /**
     * Get width value
     */
    function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height of image to render
     * 
     * @param int $height Height of generated image
     * @throws InvalidArgumentException
     */
    function setHeight($height)
    {
        if (preg_match('/^\d+$/', $height)) {
            if ($height > 0) {
                $this->height = $height;
            } else {
                throw new InvalidArgumentException('Height must be greater than zero.');
            }
        } else {
            throw new InvalidArgumentException('Height must be an integer.');
        }
    }

    /**
     * Get height value
     */
    function getHeight()
    {
        return $this->height;
    }

    /**
     * Display image and cache (if enabled)
     *
     * @throws RuntimeException
     */
    function render()
    {
        if ($this->width <= $this->maxWidth && $this->height <= $this->maxHeight) {
            $cachePath = $this->cacheDir . '/' . $this->width . '_' . $this->height . '_' . (strlen($this->backgroundColor) === 3 ? $this->backgroundColor[0] . $this->backgroundColor[0] . $this->backgroundColor[1] . $this->backgroundColor[1] . $this->backgroundColor[2] . $this->backgroundColor[2] : $this->backgroundColor) . '.png';
            header('Content-type: image/png');
            header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + $this->expires));
            header('Cache-Control: public');
            if ($this->cache === true && is_readable($cachePath)) {
                // send header identifying cache hit & send cached image
                header('img-src-cache: hit');
                print file_get_contents($cachePath);
            } else {
                // cache disabled or no cached copy exists
                // send header identifying cache miss if cache enabled
                if ($this->cache === true) header('img-src-cache: miss');

                $image = $this->createImage();

                imagepng($image);
                // write cache
                if ($this->cache === true && is_writable($this->cacheDir)) {
                    imagepng($image, $cachePath);
                }
                imagedestroy($image);
            }
        } else {
            throw new RuntimeException('Placeholder size may not exceed ' . $this->maxWidth . 'x' . $this->maxHeight . ' pixels.');
        }
    }

    private function createImage()
    {
        $image = imagecreate($this->width, $this->height);
        
        // activate alpha
        imagesavealpha($image, true);
        imagealphablending($image, false);
        
        // convert backgroundColor hex to RGB values
        list($bgR, $bgG, $bgB) = $this->hexToDec($this->backgroundColor);
        $backgroundColor = imagecolorallocatealpha($image, $bgR, $bgG, $bgB , 127);
        imagefilledrectangle($image, 0, 0, $this->width, $this->height, $backgroundColor);
        
        return $image;
    }

    function renderToFile($file)
    {
        if (!file_exists($file)) {
            touch($file);
        }
        $image = $this->createImage();
        imagepng($image, $file);
        imagedestroy($image);
    }

    /**
     * Convert hex code to array of RGB decimal values
     * 
     * @param string $hex Hex code to convert to dec
     * @return array
     * @throws InvalidArgumentException
     */
     private function hexToDec($hex)
     {
        if (strlen($hex) === 3) {
            $rgbArray = array(hexdec($hex[0] . $hex[0]), hexdec($hex[1] . $hex[1]), hexdec($hex[2] . $hex[2]));
        } else if (strlen($hex) === 6) {
            $rgbArray = array(hexdec($hex[0] . $hex[1]), hexdec($hex[2] . $hex[3]), hexdec($hex[4] . $hex[5]));
        } else {
            throw new InvalidArgumentException('Could not convert hex value to decimal.');
        }
        return $rgbArray;
     }
}
