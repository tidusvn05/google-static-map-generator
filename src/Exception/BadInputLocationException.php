<?php
/*
 * @Author: Tidusvn05 
 * @Date: 2017-06-22 19:45:15 
 * @Last Modified by: Tidusvn05
 * @Last Modified time: 2017-06-23 08:43:14
 */
namespace Tidusvn05\StaticMap\Exception;

class BadInputLocationException extends \Exception{
  protected $message = 'Bad Input Location exception';

  public function __toString()
  {
    return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
                            . "{$this->getTraceAsString()}";
  }
  
}