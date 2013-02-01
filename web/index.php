<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 1/31/13
 * Time: 6:45 PM
 * To change this template use File | Settings | File Templates.
 */

use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$navigation = array(
    array('title' => 'Home', 'link' => '/'),
    array('title' => 'Register', 'link' => '/register'),
    array('title' => 'Sessions', 'link' => '/sessions'),
//    array('title' => 'Schedule', 'link' => '/schedule'),
    array('title' => 'Speakers', 'link' => '/speakers'),
    array('title' => 'Sponsors', 'link' => '/sponsorList'),
    array('title' => 'Venue', 'link' => '/venue'),
    array('title' => 'Contact', 'link' => '/contact'),
);

$app = new Silex\Application();

require_once __DIR__ . "/database.php";

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__ . '/../views',
    ));

$app->get("/", function (Silex\Application $app) use ($navigation) {
    return $app['twig']->render('index.html.twig.twig', array(
        'navigation' => $navigation,
        'active' => 'Home'
    ));
});
$app->get("/register", function (Silex\Application $app) use ($navigation) {
    return $app['twig']->render('register.html.twig', array(
        'navigation' => $navigation,
        'active' => 'Register'
    ));
});
$app->get("/sessions", function (Silex\Application $app) use ($navigation) {

    $sqlStatement = "SELECT * from something";

    $sessions = $app['dbs']['mysql_read']->fetchAll($sqlStatement);

    return $app['twig']->render('sessions.html.twig', array(
        'navigation' => $navigation,
        'active' => 'Home',
        'sessions' => $sessions
    ));
});
$app->get("/speakers", function (Silex\Application $app) use ($navigation) {

    $sql = "SELECT * from something";

    $speakers = $app['dbs']['mysql_read']->fetchAll($sql);

    return $app['twig']->render('speakers.html.twig', array(
        'navigation' => $navigation,
        'active' => 'Home',
        'speakers' => $speakers
    ));
});
$app->get("/sponsorList", function (Silex\Application $app) use ($navigation) {

    return $app['twig']->render('sponsor_list.html.twig', array(
        'navigation' => $navigation,
        'active' => 'Sponsors'
    ));
});
$app->get("/sponsorCall", function (Silex\Application $app) use ($navigation) {

    return $app['twig']->render('sponsor_call.html.twig', array(
        'navigation' => $navigation,
        'active' => 'Sponsors'
    ));
});
$app->get("/venue", function (Silex\Application $app) use ($navigation) {

    return $app['twig']->render('venue.html.twig', array(
        'navigation' => $navigation,
        'active' => 'Venue'
    ));
});
$app->get("/contact", function (Silex\Application $app) use ($navigation) {

    return $app['twig']->render('contact.html.twig', array(
        'navigation' => $navigation,
        'active' => 'Contact'
    ));
});
$app->run();