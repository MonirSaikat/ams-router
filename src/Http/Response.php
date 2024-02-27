<?php

namespace Monir\AmsRouter\Http;

class Response
{
  protected $content;
  protected $hasJson = false;

  public function content($content)
  {
    $this->content = $content;
    return $this;
  }

  public function json($jsonVal)
  {
    $this->hasJson = true;
    $this->content = json_encode($jsonVal);
    return $this;
  }

  public function send()
  {
    echo $this->content;
  }
}
