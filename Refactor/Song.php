<?php


namespace Refactor;

class Song
{
    /** @var string */
    private $name;

    /** @var array */
    private $chords;

    /** @var string  */
    private $label;

    public function __construct(string $name, array $chords, string $label)
    {
        $this->name = $name;
        $this->chords = $chords;
        $this->label = $label;
    }

    public function chords(): array
    {
        return $this->chords;
    }

    public function label(): string
    {
        return $this->label;
    }
}