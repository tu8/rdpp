<?php
if (isset($_GET['movie'])) {
    $movie = urlencode($_GET['movie']);
    $url = "https://app.arabypros.com/api/search/$movie/0/4F5A9C3D9A86FA54EACEDDD635185/d506abfd-9fe2-4b71-b979-feff21bcad13/";
    $headers = [
        'User-Agent: okhttp/4.8.0',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($ch);
    curl_close($ch);

    $movies = json_decode($response, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Dark background */
            color: #fff;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: rgba(35, 35, 35, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #e50914; /* Red color */
        }
        .movie-card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .movie-card {
            background-color: #1c1c1c;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .movie-card:hover {
            transform: scale(1.05);
        }
        .movie-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-bottom: 2px solid #444;
        }
        .movie-title {
            font-size: 1.25rem;
            padding: 10px;
            font-weight: bold;
            text-align: center;
            background-color: #333;
            color: #fff;
        }
        .movie-details {
            padding: 10px;
            font-size: 0.9rem;
            background-color: #444;
            color: #ddd;
        }
        .btn-watch {
            background-color: #e50914; /* Red color */
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
            display: block;
            width: 80%;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .btn-watch:hover {
            background-color: #b00710; /* Darker red */
        }
        .no-results {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
            color: #e50914;
        }
        .back-btn {
            background-color: #444;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="movie-card-container">
            <?php if (!empty($movies['posters'])): ?>
                <?php 
                $hasValidMovies = false;
                foreach ($movies['posters'] as $movie): 
                    if (empty($movie['title']) || empty($movie['image']) || $movie['type'] !== 'serie') {
                        continue;
                    }
                    $hasValidMovies = true;
                ?>
                    <div class="movie-card">
                        <img src="<?php echo htmlspecialchars($movie['image']); ?>" alt="Movie Poster">
                        <div class="movie-title"><?php echo htmlspecialchars($movie['title']); ?></div>
                        <div class="movie-details">
                            <p><strong>Year:</strong> <?php echo htmlspecialchars($movie['year'] ?? 'N/A'); ?></p>
                            <p><strong>Rating:</strong> <?php echo htmlspecialchars($movie['rating'] ?? 'N/A'); ?></p>
                        </div>
                        <a href="series.php?id=<?php echo $movie['id']; ?>" class="btn-watch">Watch Now</a>
                    </div>
                <?php endforeach; ?>
                <?php if (!$hasValidMovies): ?>
                    <p class="no-results">No valid movies found in your search. Try a different name.</p>
                <?php endif; ?>
            <?php else: ?>
                <p class="no-results">No movies found. Try a different name.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="back-btn">Back to Search</a>
        </div>
    </div>
</body>
</html>  