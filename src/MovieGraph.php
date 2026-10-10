<?php
class MovieGraph
{
    private array $movies;
    private array $adjacency = [];//

    public function __construct(array $movies)
    {
        $this->movies = array_values($movies);// garante que os indices do array sejam numericos
        foreach ($this->movies as $index => $movie) {
            $connections = [
                [$movie["main_tag"], 2],
                [$movie["subtag_1"], 1],
                [$movie["subtag_2"], 1]
            ];
            foreach ($connections as [$tag, $weight]) {
                $currentWeight = $this->adjacency[$tag][$index] ?? 0;
                $this->adjacency[$tag][$index] = $currentWeight + $weight;
            }
        }
    }
    public function moviesForTag(string $tag): array
    {
        return $this->adjacency[$tag] ?? [];
    }
    public function getMovie(int $index): array
    {
        return $this->movies[$index];
    }
}