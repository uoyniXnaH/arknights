<?php

namespace Controllers;

class testCls {
    public $prm1;
    public $res1;

    function __construct($in) {
        $this->prm1 = $in;
        $this->res1 = "init";
    }

    public function getVal() {
        return [$this->prm1, $this->res1];
    }
}
