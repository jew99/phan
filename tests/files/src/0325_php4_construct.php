<?php

namespace {
class Bar325 {
    /** @return int */
    public function Bar325(array $arg) {
        self::__construct(23);  // The explicit constructor doesn't exist.
        return 42;
    }
}

class Foo325 extends Bar325 {
    public $arg;
    public function __construct(int $arg) {
        parent::Bar325($arg);
    }
}
// error happens with/without the below lines.
$f325 = new Bar325(11);
$f325 = new Foo325(11);
}  // end of global namespace

namespace NS325 {
class X325 {
    /** @return int (should not warn about being static) */
    public static function X325(array $arg) {
        return 42;
    }
}

class Y325 extends X325 {
    public $arg;
    public function __construct(int $arg) {
        parent::__construct($arg);  // should warn that it doesn't exist
        parent::X325($arg);  // should warn that it is incompatible
    }
}
// error happens with/without the below lines.
$f325 = new X325(11);  // PhanParamTooMany
$f325 = new Y325(11);
}  // end of NS325

// this should not emit PhanCompatiblePHP8PHP4Constructor because the class is in a non-global namespace
namespace NotPHP4Class325 {
    class NoWarning {
        function NoWarning() {
            return 42;
        }
    }
}

namespace {
    // no PhanCompatiblePHP8PHP4Constructor warning for interfaces
    interface Interface325 {
        public function Interface325() : int;
    }

    // no PhanCompatiblePHP8PHP4Constructor warning for traits
    trait Trait325 {
        public function Trait325(): int
        {
            return 42;
        }
    }

    // PhanCompatiblePHP8PHP4Constructor warning test for different capitalization of class/method names
    abstract class Abstract325 {
        function AbStRaCt325() { // throws a warning
            echo 42;
        }
    }
}