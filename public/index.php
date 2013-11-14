<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new \Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__) . '/views',
));

$app->get('/', function() use($app) {
    return $app['twig']->render('index.twig');
});

$app->match('/count', function() use($app) {
    $date = gmdate('Ymd');

    $redis = new Redis();
    $redis->connect('localhost', 6969);

    if ($app['request']->getMethod() === 'POST') {
        $add = intval($_POST['add']);
        $add > 0 ? $redis->incrby($date, $add) : $redis->decrby($date, abs($add));
    }

    $val = $redis->get($date);
    return $app->json(array('count' => intval($redis->get($date)) ?: 0));

})->method('GET|POST');

$app->get('/history', function() use($app) {

    $redis = new Redis();
    $redis->connect('localhost', 6969);

    $keys = $redis->keys('*');
    $vals = $redis->mget($keys);

    $history = array_combine($keys, $vals);
    krsort($history);

    return $app['twig']->render('history.twig', array(
        'history' => $history
    ));

});

$app->run();
