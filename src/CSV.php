<?php

namespace LAT\DataReader;

class CSV extends Base {

  protected $fieldseparator;
  protected $skiprows;

  public function __construct($fname, $fieldseparator, $skiprows = 0) {
    parent::__construct($fname);
    $this->fieldseparator = $fieldseparator;
    $this->skiprows = $skiprows;
  }

  public function open() {
    parent::open();
    while ($this->skiprows > 0) {
      fgetcsv($this->stream, 0, $this->fieldseparator);
      $this->skiprows--;
    }
  }

  public function nextRecord() {
    return fgetcsv($this->stream, 0, $this->fieldseparator);
  }

}
