<?php

use Core\Container;

test('It can resolve something out of the container.', function () {
    // Arrange.
    $container = new Container();

    $container->bind('foo', function () {
        return 'bar';
    });

    // Action.
    $result = $container->resolve('foo');

    // Assert or Expect.
    expect($result)->toEqual('bar');
});
