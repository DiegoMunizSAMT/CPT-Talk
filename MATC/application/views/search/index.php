<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MATC</title>
  <link rel="stylesheet" href="application/assets/css/search.css">
</head>
<body>

<div id="container">
  <div class="form-section">
    <h1>Anime Search</h1>
    <form action="" method="POST">
        <input type="text" name="anime_name" id="anime_name" placeholder="Anime name" value="<?php echo isset($_POST['anime_name']) ? htmlspecialchars($_POST['anime_name']) : ''; ?>">
        <!-- <input type="submit" value="Search"> -->
    </form>
  </div>

  <div class="anime-wrapper">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anime_name = $_POST["anime_name"];
    $api_url = "https://api.jikan.moe/v4/anime?q=" . urlencode($anime_name);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($content, true);

    $animes = array();  // Array to store the anime information

    foreach ($data['data'] as $anime) {
        // Skip if the type is 'Music'
        if ($anime['type'] == 'Music') {
            continue;
        }
		
		$mal_id = $anime['mal_id'];
		
        $title = 'Title not available';
        foreach ($anime['titles'] as $anime_title) {
            if ($anime_title['type'] == 'English') {
                $title = $anime_title['title'];
                break;
            } elseif ($anime_title['type'] == 'Default') {
                $title = $anime_title['title'];
            }
        }
        $image_url = $anime['images']['jpg']['image_url'];

        // Add the anime information to the array
        $animes[] = array(
			'mal_id' => $mal_id,
            'title' => $title,
            'image_url' => $image_url
        );
    }

    // Define a custom sorting function
    usort($animes, function($a, $b) use ($anime_name) {
        // Calculate the similarity between the anime title and the search query
        similar_text($anime_name, $a['title'], $percentA);
        similar_text($anime_name, $b['title'], $percentB);

        // Sort in descending order of similarity
        return $percentB <=> $percentA;
    });

    // Now you can print the data from the array, or sort it, etc.
    foreach ($animes as $key => $anime) {
		$div_id = $anime['mal_id'];
		echo "<div id='$div_id' class='anime-container' title='" . $anime['title'] . "' onclick='saveAnime(\"".$anime['mal_id']."\")'>";
		echo "<img src='" . $anime['image_url'] . "' alt='Anime Image'>";
		echo $anime['title'];
		echo "</div>";
	}
}
?>
  </div>
</div>

<script src="application/assets/js/search.js"></script>

</body>
</html>