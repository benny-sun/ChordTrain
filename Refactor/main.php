<?php

require __DIR__ . '/../vendor/autoload.php';

use Refactor\Song;
use Refactor\ChordDegree;
use Refactor\MusicLibrary;


$musicLibrary = new MusicLibrary();
$musicLibrary->add(new Song('imagine', ['c', 'cmaj7', 'f', 'am', 'dm', 'g', 'e7'], 'easy'));
$musicLibrary->add(new Song('somewhere_over_the_rainbow', ['c', 'em', 'f', 'g', 'am'],'easy'));
$musicLibrary->add(new Song('tooManyCooks', ['c', 'g', 'f'],'easy'));
$musicLibrary->add(new Song('iWillFollowYouIntoTheDark', ['f', 'dm', 'bb', 'c', 'a', 'bbm'],'medium'));
$musicLibrary->add(new Song('babyOneMoreTime', ['cm', 'g', 'bb', 'eb', 'fm', 'ab'], 'medium'));
$musicLibrary->add(new Song('creep', ['g', 'gsus4', 'b', 'bsus4', 'c', 'cmsus4', 'cm6'], 'medium'));
$musicLibrary->add(new Song('paperBag', ['bm7', 'e', 'c', 'g', 'b7', 'f', 'em', 'a', 'cmaj7', 'em7', 'a7', 'f7', 'b'], 'hard'));
$musicLibrary->add(new Song('toxic', ['cm', 'eb', 'g', 'cdim', 'eb7', 'd7', 'db7', 'ab', 'gmaj7', 'g7'], 'hard'));
$musicLibrary->add(new Song('bulletproof', ['d#m', 'g#', 'b', 'f#', 'g#m', 'c#'], 'hard'));

$chordDegree = new ChordDegree($musicLibrary);
$chordDegree->classify(['d', 'g', 'e', 'dm']);
