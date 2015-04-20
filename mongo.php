<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 20.04.2015
 * Time: 10:57
 */

// automatische Verbindung mit localhost:27017
$mongo = new MongoClient();
// $blog ist ein MongoDB-Objekt (vergleichbar mit MySQL-Datenbank, wird automatisch angelegt)
$quiz = $mongo->quiz;
// $posts ist eine MongoCollection (vergleichbar mit SQL-Tabelle, wird automatisch angelegt)
$questions = $quiz->questions;

// schreiben
$questions->insert(array(
    'slug' => 'question-1',
    'question' => 'Wie hoch ist der Eiffeltrum?',
    'answers' => array(
        '33m'  => true,
        '23m'  => false,
        '133m' => false,
        '13m'  => false
    ),
    'date' => new MongoDate(),
    'author' => array(
        'name' => 'Felix',
        'email' => 'schuchmann@gmail.com'
    )
));

$questions->update(
    array( 'slug' => 'question-1'), // quasi eine where-Bedingung
    array( '$set' => array( // ohne set $set würde es den ganzen Post ersetzen
        'flaws' => array(
            'Eifelturm schreibt man mit einem F'
        )
    ))
);

$doc = $questions->findOne( array( 'slug' => 'question-1'));
echo '<h1>'.$doc['question'].'</h1>';
echo '<em>'.$doc['author']['name'].' &lt;'.$doc['author']['email'].'&gt;</em>';
echo '<ul>';
foreach( $doc['answers'] as $key => $value) {
    echo '<li>'.$key.'</li>';
}
echo '</ul>';