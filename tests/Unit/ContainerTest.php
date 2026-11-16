<?php

use Core\Container;

test('it can resolve something out of the container', function () {
    $container = new Container();

    $container->bind('foo', fn () => 'bar');

    expect($container->resolve('foo'))->toEqual('bar');
});

test('it throws if the binding does not exist', function () {
    (new Container())->resolve('nope');
})->throws(Exception::class);