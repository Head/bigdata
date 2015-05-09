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


$questions->insert(array(
    'slug' => 'question-2',
    'question' => 'Frage2?',
    'answers' => array(
        '1'  => true,
        '2'  => false,
        '3' => false,
        '4'  => false
    ),
    'date' => new MongoDate(),
    'author' => array(
        'name' => 'Felix',
        'email' => 'schuchmann@gmail.com'
    )
));


$questions->insert(array(
    'slug' => 'question-3',
    'question' => 'Frage3?',
    'answers' => array(
        'a'  => true,
        'b'  => false,
        'c' => false,
        'd'  => false
    ),
    'date' => new MongoDate(),
    'author' => array(
        'name' => 'Felix',
        'email' => 'schuchmann@gmail.com'
    )
));


$questions->insert(array(
    'slug' => 'question-3',
    'question' => 'Frage4?',
    'answers' => array(
        'a'  => true,
        'b'  => false,
        'c' => false,
        'd'  => false
    ),
    'date' => new MongoDate(),
    'author' => array(
        'name' => 'Felix',
        'email' => 'schuchmann@gmail.com'
    ),
    'flaws' => array(
        'Bla'
    )
));

$questions->update(
    array( 'slug' => 'question-1'), // quasi eine where-Bedingung
    array( '$addToSet' => array( // ohne set $set würde es den ganzen Post ersetzen
        'flaws' => 'Eifelturm schreibt man mit einem F'
    ))
);

$questions->update(
    array( 'slug' => 'question-1'), // quasi eine where-Bedingung
    array( '$addToSet' => array( // ohne set $set würde es den ganzen Post ersetzen
        'flaws' => 'Die Frage ist doof'
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

echo '<hr>';
echo 'Anmerkungen zur Frage:<br/>';
echo '<ul>';
foreach( $doc['flaws'] as $key => $value) {
    echo '<li>'.$value.'</li>';
}
echo '</ul>';


$doc = $questions->find( );
var_dump($doc);

/*
 * 1. Ausgabe aller Fragen (d.h. der Fragestellungen) mit den zugeh¨origen Antworttexten.
2. Ausgabe aller Fragen (d.h. der Fragestellungen) mit den zugeh¨origen Autorennamen.
3. Ausgabe aller Fragen (d.h. der Fragestellungen), fur die bislang kein M ¨ ¨angel vermerkt
wurde.
Hinweis: Achten Sie darauf, dass dies (abh¨angig von Ihrer Modellierung) sowohl Fragen
sein k¨onnen, bei denen fur die M ¨ ¨angelanzahl 0 eingetragen wurden als auch Fragen, fur ¨
die dieses Attribut bislang gar nicht gespeichert wurde.
4. Ausgabe aller Fragen (d.h. der Fragestellungen), fur die mehr als ein M ¨ ¨angel vermerkt
wurde.
5. Ausgabe aller Fragen (d.h. der Fragestellungen), die ein bestimmtes Stichwort (Ihrer
Wahl — abh¨angig von den gew¨ahlten Beispieldaten) enthalten.
6. Ausgabe der Anzahl aller Fragen.
7. Uberpr ¨ ufung, ob es Fragen gibt, f ¨ ur die weniger als vier Antworten hinterlegt wurden. In ¨
diesem Fall soll die Id dieser Fragen ausgegeben werden.
8. Uberpr ¨ ufung, ob es Fragen gibt, f ¨ ur die mehr als eine Antwort als richtig markiert wurde. ¨
In diesem Fall soll die Id dieser Fragen ausgegeben werden.
 */