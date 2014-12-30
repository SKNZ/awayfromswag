<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 30/12/14
 * Time: 00:04
 */

namespace SwagFramework\XML;

/**
 * This class creates a XML file (or rewrites it)
 * and write everything you want on it with the tags you choose.
 * Class XML
 * @package SwagFramework\XML
 */
class XML
{
    /**
     * This is the name of the file we want to create.
     * @var string
     */
    private $name;

    /**
     * This is the name of the very first tag in your file
     * (the doctype tag in HTMl for example)
     * @var string
     */
    private $header;

    /**
     * This is the file that we want to edit
     * @var SplFileObject
     */
    private $file;

    public function __construct($name, $header)
    {
        $this->name = $name;
        $this->header = $header;

        // Throw a runtime exception if not writable
        $this->file = new \SplFileObject($name, 'w');

        $this->begin($this->header);
    }

    public function begin($header)
    {
        $tag = '<?' . $header . '?>';
        $tag .= "\n";

        $this->file->fwrite($tag);
    }

    public function writeTag($content = array())
    {
        $size = count($content);

        if($size < 1 || $size > 2)
            throw XMLNotWritableException($content);

        else if(!isset($content['title']) || !isset($content['content']))
            throw XMLArrayBadFormatException();

        $tag = '<' . $content['title'];
        $tag .= isset($content['option']) ? ' ' . $content['option'] : '';
        $tag .= '>';
        $tag .= $content['content'];
        $tag .= '</' . $content['title'] . '>';
        $tag .= "\n";

        $this->file->fwrite($tag);
    }

    public function writeOrphanTag($content)
    {
        $tag = '<' . $content;
        $tag .= isset($content['option']) ? ' ' . $content['option'] : '';
        $tag .= '/>';
        $tag .= "\n";
        $this->file->fwrite($tag);
    }

    public function write($content = array())
    {
          if(is_array($content['content']))
          {
              $tag = '<' . $content['title'] . '>';
              $tag .= "\n";
              $this->file->fwrite($tag);

              foreach($content['content'] as $item)
              {
                  $this->file->fwrite("\t");
                  $this->write($item);
              }

              $tag = '</' . $content['title'] . '>';
              $this->file->fwrite($tag);
          }
          else
          {
              if(!isset($content['content']))
                  $this->writeOrphanTag($content);
              else
                  $this->writeTag($content);
          }
    }
}