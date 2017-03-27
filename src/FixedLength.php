<?php

namespace LAT\DataReader;

class FixedLength extends Base {

    protected $rowlengths;
    protected $cursor;
    protected $lineLen;

    public function __construct($fname, $offset, $lineLen, $rowlengths) {
        parent::__construct($fname);
        $this->rowlengths = $rowlengths;
        $this->cursor = $offset;
        $this->lineLen = $lineLen;
    }

    public function open() {
        parent::open();
        fseek($this->stream, $this->cursor);
    }

    public function nextRecord() {
        $fields = [];
        $c = 0;
        if ($line = fread($this->stream, $this->lineLen)) {
            foreach ($this->rowlengths as $v) {
                $field = trim(substr($line, $c, $v));
                array_push($fields, $field);
                $c += $v;
            }
            return $fields;
        }
    }

}
