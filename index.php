<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
  class Movie {
    public $title;
    public $year;
    public $language;
    public $genres;
    public $cast;
    public $scores;

    function __construct($_title, $_year=null, $_language="", $_genres=[], $_cast=[], $_scores=[])
    {
      $this->title = $_title;
      $this->year = $_year;
      $this->language = $_language;
      $this->genres = $_genres;
      $this->cast = $_cast;
      $this->scores = $_scores;
    }

    public function addGenre($_genre)
    {
      if (!in_array($_genre, $this->genres))
      $this->genres[] = $_genre;
    }

    public function addCastMember($_cast_member_name, $_cast_member_role, $_cast_length = 0)
    {
      $_cast_length = count($this->cast);

      if (!in_array($_cast_member_name, $this->cast)) {
      $this->cast[$_cast_length]["name"] = $_cast_member_name;
      $this->cast[$_cast_length]["role"] = $_cast_member_role;
      }
    }

    public function addScore($_score)
    {
      $this->scores[] = $_score;
    }

    public function getAverageScore()
    {
      $scoresSum = 0;
      foreach ($this->scores as $score) {
        $scoresSum += $score;
      }
      $averageScore = $scoresSum / count($this->scores);
      return $averageScore;
    }
  }

  $jurassic_park = new Movie("Jurassic Park", 1993, "English");
  $jurassic_park->addGenre("Action");
  $jurassic_park->addGenre("Sci-fi");
  $jurassic_park->addCastMember("Richard Attenborough", "John Hammond");
  $jurassic_park->addCastMember("Laura Dern", "Dr. Ellie Sattler");
  $jurassic_park->addScore(10);
  $jurassic_park->addScore(9);
  $jurassic_park->addScore(8);
  // var_dump($jurassic_park);

  $blade_runner = new Movie("Blade Runner", 1982, "English");
  $blade_runner->addGenre("Action");
  $blade_runner->addGenre("Sci-fi");
  $blade_runner->addCastMember("Harrison Ford", "Rick Deckard");
  $blade_runner->addCastMember("Sean Young", "Rachael");
  $blade_runner->addScore(8);
  $blade_runner->addScore(7);
  $blade_runner->addScore(9);
  // var_dump($blade_runner);

  $movies = [];
  $movies[] = $jurassic_park;
  $movies[] = $blade_runner;

  // var_dump($movies);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movies</title>
</head>
<body>
  <div>
    <?php foreach($movies as $movie) { ?>
      <h2><?php echo "Title:". " " . $movie->title ?></h2>
      <h3><?php echo "Year:". " " . $movie->year ?></h3>
      <h5><?php echo "Language:". " " . $movie->language ?></h5>
      <h3>Genres</h3>
      <ul>
        <?php foreach($movie->genres as $genre) { ?>
          <li><?php echo $genre ?></li>
        <?php } ?>
      </ul>
      <h3>Cast</h3>
      <ul>
        <?php foreach($movie->cast as $cast_member) { ?>
          <li>
            <p><?php echo "Name:". " " . $cast_member["name"]; ?></p>
            <p><?php echo "Role:". " " . $cast_member["role"]; ?></p>
          </li>
        <?php } ?>
      </ul>
      <h5><?php echo "Average score:" . " " . $movie->getAverageScore() ?></h5>
    <?php } ?>
  </div>
</body>
</html>