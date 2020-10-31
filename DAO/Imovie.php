<?php 
namespace DAO;

use Models\Movie as Movie;

interface Imovie{
    function addMovie(Movie $movie);
    function deleteMovie($id_movie);
    function getAllMovies();
}
?>