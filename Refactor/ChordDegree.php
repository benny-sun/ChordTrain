<?php


namespace Refactor;

class ChordDegree
{

    /** @var array|Song[] */
    private $songs;

    public function __construct(MusicLibrary $musicLibrary)
    {
        $this->songs = $musicLibrary->songs();
    }

    public function labelCounts(): array
    {
        $labels = [];
        /** @var Song $song */
        foreach ($this->songs as $song) {
            $labels[] = $song->label();
        }

        return array_count_values($labels);
    }

    public function getNumberOfSongs(): int
    {
        return count($this->songs);
    }

    public function labelProbabilities(): array
    {
        $labelCounts = $this->labelCounts();
        $numberOfSongs = $this->getNumberOfSongs();
        $result = [];
        foreach ($labelCounts as $label_name => $label_count) {
            $result[$label_name] = $label_count / $numberOfSongs;
        }

        return $result;
    }

    public function chordCountsInLabels(): array
    {
        $result = [];
        /** @var Song $song */
        foreach ($this->songs as $song) {
            $chords = $song->chords();
            foreach ($chords as $chord) {
                $result[$song->label()][$chord] = isset($result[$song->label()][$chord])
                    ? $result[$song->label()][$chord] += 1
                    : 1;
            }
        }

        return $result;
    }

    public function probabilityOfChordsInLabels(): array
    {
        $numberOfSongs = $this->getNumberOfSongs();
        $result = $this->chordCountsInLabels();
        foreach ($result as &$label) {
            foreach ($label as &$chord_count) {
                $chord_count = $chord_count * 1.0 / $numberOfSongs;
            }
        }

        return $result;
    }

    public function classify(array $chords)
    {
        $labelProbabilities = $this->labelProbabilities();
        print_r($labelProbabilities);
        $classified = [];
        foreach ($labelProbabilities as $label => $probability) {
            $first = $probability + 1.01;
            foreach ($chords as $chord) {
                $probabilityOfChordsInLabels = $this->probabilityOfChordsInLabels();
                $probabilityOfChordInLabel = $probabilityOfChordsInLabels[$label][$chord] ?? null;
                if ($probabilityOfChordInLabel) {
                    $first = $first * ($probabilityOfChordInLabel + 1.01);
                }
            }
            $classified[$label] = $first;
        }
        print_r($classified);
    }
}