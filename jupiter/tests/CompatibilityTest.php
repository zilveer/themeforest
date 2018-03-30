<?php
use org\bovigo\vfs\vfsStream;

require_once __DIR__ . '/../framework/admin/control-panel/logic/compatibility.php';
require_once __DIR__ . '/../vendor/autoload.php';
class CompatibilityTest extends PHPUnit_Framework_TestCase
{
    private $root;
    private $compat;

    public function setUp()
    {
        $this->compat = new Compatibility();
    }

    public function testItCanCheckForDirectoryExistAndCreateIfNotExist()
    {
        vfsStream::setup("upload-writable");
        $path = vfsStream::url('upload-writable');
        $this->compat->setTemplateDir($path);
        $result = $this->compat->checkAndCreate($this->compat->getTemplateDir());
        $this->assertEquals(array('status' => true), $result);

        vfsStream::setup("upload-notwritable", 0444);
        $path = vfsStream::url('upload-notwritable');
        $this->compat->setTemplateDir($path);
        $result  = $this->compat->checkAndCreate($this->compat->getTemplateDir());
        $message = [
            'sys_msg'       => $path . ' directory is not writable, ',
            'sys_recommend' => 'Set read/write (0775) permission for this directory .',
            'link_href'     => '',
            'link_title'    => '',
            'type'          => 'error',
            'status'        => false,
        ];
        $this->assertEquals($message, $result);

    }
    public function testItCanCheckWritableDirectories()
    {
        vfsStream::setup("upload-writable");
        $path = vfsStream::url('upload-writable');
        $this->compat->setTemplateDir($path);
        $result = $this->compat->isWritable($this->compat->getTemplateDir());
        $this->assertTrue($result);

        vfsStream::setup("upload-notwritable", 0444);
        $path = vfsStream::url('upload-notwritable');
        $this->compat->setTemplateDir($path);
        $result = $this->compat->isWritable($this->compat->getTemplateDir());
        $this->assertFalse($result);

    }
}
