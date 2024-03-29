<?php

$app->get('/chapter2',function() use($app) {
    $sql = 'select * from message where user_id = ?';
    $con = $app->db;
    $sth = $con->prepare($sql);
    $sth->execute(array($app->request->get('user_id')));
    $results = $sth->fetchAll();
    return $app->render('chapter2.twig',['messages' => $results]);
});

$app->post('/chapter2', function() use($app) {
    $sql = 'insert into message values(null,?,?,?,now(),now())';
    $con = $app->db;
    $sth = $con->prepare($sql);
    $sth->execute( array( $app->request->post('user_id'),$app->request->post('title'),$app->request->post('message')));
    return $app->redirect('/chapter2?user_id=1000007');
});
