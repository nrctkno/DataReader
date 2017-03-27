<?php

namespace LAT\DataReader;

abstract class Base {

  public $fname;
  public $stream;

  public function __construct($fname) {
    $this->fname = $fname;
  }

  public function open() {
    $this->stream = fopen($this->fname, "r");
  }

  public function close() {
    fclose($this->stream);
  }

  public abstract function nextRecord();
}
