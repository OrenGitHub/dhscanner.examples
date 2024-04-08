<?php
class SomeClassTheAppLoaded {
    public $data = null;
    public function __construct($data) { $this->data = $data; }
    public function __destruct() { system($this->data); }
}

$exists = file_exists("phar:///uploads/v1/user/profile.png");
print_r("file exists: $exists\n");
