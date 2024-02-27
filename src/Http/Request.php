<?php

namespace Monir\AmsRouter\Http;

class Request
{
  protected $data;

  public function __construct()
  {
    $this->data = $_REQUEST;
  }

  public function get($key, $default = null)
  {
    return isset($this->data[$key]) ? $this->data[$key] : $default;
  }

  public function all()
  {
    return $this->data;
  }
}
