<?php

require_once __DIR__ . '/MovieGraph.php';

class RecommendationService
{
    public function recommend(
        array $movies,
        array $topTags,
        array $viewedMovieIds,
        int $limit = 10
    ): array {
        $graph = new MovieGraph($movies);
        $viewedLookup = array_fill_keys($viewedMovieIds, true);
        $scores = [];

        // Percorre somente as conexões das tags preferidas.
        foreach ($topTags as $tag => $preferenceWeight) {
            foreach ($graph->moviesForTag((string) $tag) as $index => $weight) {
                $scores[$index] = ($scores[$index] ?? 0)
                    + ($preferenceWeight * $weight);
            }
        }

        // Preserva a ordem original do catálogo nos empates.
        ksort($scores);

        $recommendations = [];

        foreach ($scores as $index => $score) {
            $movie = $graph->getMovie($index);

            if (isset($viewedLookup[$movie['id']]) || $score <= 0) {
                continue;
            }

            $movie['score'] = $score;
            $recommendations[] = $movie;
        }

        usort(
            $recommendations,
            static fn(array $a, array $b): int =>
                $b['score'] <=> $a['score']
        );

        return array_slice($recommendations, 0, $limit);
    }
}