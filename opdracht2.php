<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$date = date('d-m-Y', strtotime("+1 day"));
$url = "http://api.filmtotaal.nl/filmsoptv.xml?apikey=ubwb6qugs6i7wrsqotwemdeae0s7muyw&dag=".$date."&sorteer=0"; 
$ch = curl_init();
//stel opties in 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//voor de cURL opdracht uit
$data = curl_exec($ch);
curl_close($ch);
//Zet de data om naar xml element
$xmldoc = new SimpleXMLElement($data);
?>
<html>
<head>
<title>PHP API Tolga 83396</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=3">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class = "container">  
<div class="card-columns" >
<?php
foreach ($xmldoc->film as $film)
{
    $titel      = $film->titel;
    $tagline    = $film->tagline;
    $jaar       = $film->jaar;
    $genre      = $film->genre;
    $cast       = $film->cast;
    $land       = $film->land;
    $zender     = $film->zender;
    $cover      = $film->cover;
    $ft_link    = $film->ft_link;
    $imdb_id    = $film->imdb_id;
    $imdb_votes = $film->imdb_votes;
    $synopsis   = $film->synopsis;
    $duur       = $film->duur;
    $rating = $film->imdb_rating;    
?>
            <div class="card">
                    <img class="card-img-top" src="<?php echo $cover;?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $titel." (". $jaar.")";?></h5>
                        <p class="card-text"><?php echo $synopsis. "<br/><br>";
                            echo"Genre : ".$genre . "<br/>";
                            echo "Cast : ". $cast . "<br/>";
                            echo "IMDB Rating : ".$rating."⭐ <br/>";
                            echo "IMDB Votes : ". $imdb_votes."<br/><br>";
                            echo "Duur : ". $duur." Minuten"."<br/>";
                            echo "starttijd : " . date("H:m",(int)$film->starttijd). " uur". "<br/>";
                            echo "eindtijd : " . date("H:m", (int)$film->eindtijd). " uur". "<br/>";?></p>
                            <a href="<?php echo"https://www.imdb.com/title/tt".$imdb_id;?>">IMDB Link</a><br>
                            <a href="<?php echo $ft_link;?>">Film Totaal link</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?php echo "Land = ".$land.""; echo " - - Zender = ".$zender."<br/>";?></small>
                    </div>
            </div>
<?php } ?>

</div>
</div>
</body>
</html>