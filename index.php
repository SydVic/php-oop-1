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

    public $min_age;
    public $flag;

    function __construct($_title, $_min_age, $_year=null, $_language="", $_genres=[], $_cast=[], $_scores=[])
    {
      $this->title = $_title;
      $this->year = $_year;
      $this->language = $_language;
      $this->genres = $_genres;
      $this->cast = $_cast;
      $this->scores = $_scores;
      $this->min_age = $_min_age;
 
      if ($this->min_age === 18) {
        $this->flag = "red";
      } elseif ($this->min_age === 16) {
        $this->flag = "yellow";
      } else {
        $this->flag = "green";
      }
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

  $jurassic_park = new Movie("Jurassic Park", 14, 1993, "English");
  $jurassic_park->addGenre("Action");
  $jurassic_park->addGenre("Sci-fi");
  $jurassic_park->addCastMember("Richard Attenborough", "John Hammond");
  $jurassic_park->addCastMember("Laura Dern", "Dr. Ellie Sattler");
  $jurassic_park->addScore(10);
  $jurassic_park->addScore(9);
  $jurassic_park->addScore(8);
  $jurassic_park->addScore(10);
  // var_dump($jurassic_park);

  $blade_runner = new Movie("Blade Runner", 16, 1982, "English");
  $blade_runner->addGenre("Action");
  $blade_runner->addGenre("Sci-fi");
  $blade_runner->addCastMember("Harrison Ford", "Rick Deckard");
  $blade_runner->addCastMember("Sean Young", "Rachael");
  $blade_runner->addScore(8);
  $blade_runner->addScore(7);
  $blade_runner->addScore(9);
  // var_dump($blade_runner);

  $interceptor_road_warrior = new Movie("Interceptor -Road Warrior", 18, 1981, "English");
  $interceptor_road_warrior->addGenre("Action");
  $interceptor_road_warrior->addGenre("Sci-fi");
  $interceptor_road_warrior->addCastMember("Mel Gibson", "Max Rockatansky");
  $interceptor_road_warrior->addCastMember("Bruce Spence", "The Gyro Captain");
  $interceptor_road_warrior->addScore(9);
  $interceptor_road_warrior->addScore(6);
  $interceptor_road_warrior->addScore(8);
  // var_dump($interceptor_road_warrior);

  $movies = [];
  $movies[] = $jurassic_park;
  $movies[] = $blade_runner;
  $movies[] = $interceptor_road_warrior;
  // var_dump($movies);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movies</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div>
    <?php foreach($movies as $movie) { ?>
      <h2><?php echo "Title:". " " . $movie->title ?></h2>
      <h4 class="<?php echo $movie->flag ?>"><?php echo "Age " . $movie->min_age . "+" ?></h4>
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