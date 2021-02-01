<?php


namespace Refactor;


class MusicLibrary
{
    private $songs = [];

    /**
     * @param Song $song
     * @return $this
     */
    public function add(Song $song): self
    {
        $this->songs[] = $song;

        return $this;
    }

    /**
     * @return array
     */
    public function songs(): array
    {
        return $this->songs;
    }
}