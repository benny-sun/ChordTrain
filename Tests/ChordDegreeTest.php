<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Refactor\ChordDegree;
use Refactor\MusicLibrary;
use Refactor\Song;


class ChordDegreeTest extends TestCase
{

    private $musicLibrary;

    public function setUp()
    {
        parent::setUp();

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

        $this->musicLibrary = $musicLibrary;
    }

    /**
     * @dataProvider chordsProvider
     */
    public function testClassify(array $chords, $expected)
    {
        $this->expectOutputString($expected);

        $chordDegree = new ChordDegree($this->musicLibrary);
        $chordDegree->classify($chords);
    }

    public function chordsProvider()
    {
        return [
            'case.1' => [
                'chords' => ['d', 'g', 'e', 'dm'],
                'expected' => 'Array
(
    [easy] => 0.33333333333333
    [medium] => 0.33333333333333
    [hard] => 0.33333333333333
)
Array
(
    [easy] => 2.0230948271605
    [medium] => 1.8557586131687
    [hard] => 1.8557586131687
)
',
            ],
            'case.2' => [
                'chords' => ['f#m7', 'a', 'dadd9', 'dmaj7', 'bm', 'bm7', 'd', 'f#m'],
                'expected' => 'Array
(
    [easy] => 0.33333333333333
    [medium] => 0.33333333333333
    [hard] => 0.33333333333333
)
Array
(
    [easy] => 1.3433333333333
    [medium] => 1.5060259259259
    [hard] => 1.688422399177
)
',
            ],
        ];
    }
}