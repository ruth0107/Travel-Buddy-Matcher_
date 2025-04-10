
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Travel Buddy Matcher</title>
</head>
<body>
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h2 class="m-0">Travel Buddy Matcher</h2>
            </div>
            <nav>
                <ul class="list-inline m-0">
                    <li class="list-inline-item"><a href="user.php" class="text-white">Home</a></li>
                    <li class="list-inline-item"><a href="discover.php" class="text-white">Discover</a></li>
                    <li class="list-inline-item"><a href="matches.php" class="text-white">Matches</a></li>
                    <li class="list-inline-item"><a href="status.php" class="text-white">Status</a></li>
                    <li class="list-inline-item"><a href="profile.php" class="text-white">Profile</a></li>
                    <li class="list-inline-item"><a href="index.html" class="text-white">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero-banner">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" id="hero__image">
                    <img src="./assets/images/hero.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./assets/images/hero2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./assets/images/hero4.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
        <div class="hero-content text-white text-center py-5">
            <div class="container">
                <h2 class="hero__title mb-4">Your Next Adventure Awaits</h2>
                <p class="mb-4">Find your perfect travel buddy and explore the world together.</p>
                <a href="discover.html" class="btn btn-primary" id="button__hero">Find your Buddy</a>
            </div>
        </div>
    </section>


    <section id="discover-places" class="discover-places">
        <div class="container">
            <h1 class="section-heading">Check out Places to Visit this Summer</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="./assets/images/summer1.jpg" class="card-img" alt="Image 1">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 id="discover-title" class="card-title">Lakshwadeep Islands</h5>
                                    <p id="discover-text" class="card-text">Escape to the breathtaking beauty of Lakshadweep this summer 
                                        for a slice of paradise, where crystal-clear waters and golden sands beckon, 
                                        and each moment is a precious memory in the making.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 id="discover-title" class="card-title">Miami</h5>
                                    <p id="discover-text" class="card-text">Experience the vibrant energy of Miami this summer, where sun-kissed beaches, 
                                        pulsating nightlife, and eclectic culture collide to create an unforgettable 
                                        escape filled with endless possibilities.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="./assets/images/summer2.jpg" class="card-img" alt="Image 1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="./assets/images/summer3.jpg" class="card-img" alt="Image 1">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 id="discover-title" class="card-title">Goa</h5>
                                    <p id="discover-text" class="card-text">Discover the magic of Goa this summer, where golden sands, 
                                        azure waters, and a laid-back vibe beckon you to unwind, indulge, and create 
                                        timeless memories in this tropical paradise.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    


    
        <section class="featured__profiles py-5">
            <div class="container">
                <h1 class="mb-4" style="color: #ffffff; padding-bottom: 10px;">Featured Profiles</h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile p-3 mb-4 bg-light">
                            <img src="./assets/images/David.png" alt="Profile Picture" class="img-fluid rounded-circle mb-3">
                            <h3 class="mb-2">David</h3>
                            <p class="mb-2">Destination: Bali</p>
                            <p class="mb-2">Month Travelling: April</p>
                            <p class="mb-2">Travel Style: Relaxation</p>
                            <button class="btn btn-primary">Message</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile p-3 mb-4 bg-light">
                            <img src="./assets/images/Brook.png" alt="Profile Picture" class="img-fluid rounded-circle mb-3">
                            <h3 class="mb-2">Brook</h3>
                            <p class="mb-2">Destination: Lakshadweep</p>
                            <p class="mb-2">Month Travelling: May</p>
                            <p class="mb-2">Travel Style: Nature Lover</p>
                            <button class="btn btn-primary">Message</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile p-3 mb-4 bg-light">
                            <img src="./assets/images/Marilyn.png" alt="Profile Picture" class="img-fluid rounded-circle mb-3">
                            <h3 class="mb-2">Marilyn</h3>
                            <p class="mb-2">Destination: Goa</p>
                            <p class="mb-2">Month Travelling: May</p>
                            <p class="mb-2">Travel Style: Adventure</p>
                            <button class="btn btn-primary">Message</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile p-3 mb-4 bg-light">
                            <img src="./assets/images/Julie.png" alt="Profile Picture" class="img-fluid rounded-circle mb-3">
                            <h3 class="mb-2">Julie</h3>
                            <p class="mb-2">Destination: Miami</p>
                            <p class="mb-2">Month Travelling: May</p>
                            <p class="mb-2">Travel Style: Luxury</p>
                            <button class="btn btn-primary">Message</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile p-3 mb-4 bg-light">
                            <img src="./assets/images/profile1.png" alt="Profile Picture" class="img-fluid rounded-circle mb-3">
                            <h3 class="mb-2">Justin</h3>
                            <p class="mb-2">Destination: Singapore</p>
                            <p class="mb-2">Month Travelling: April</p>
                            <p class="mb-2">Travel Style: Cultural</p>
                            <button class="btn btn-primary">Message</button>
                        </div>
                    </div>
                    <div class="card discover-card">
                        <div class="card-body">
                          <h5 class="card-title">Discover More Travellers</h5>
                          <a href="discover.php" class="btn btn-primary">Check Out Profiles</a>
                        </div>
                      </div>                      
                    
                </div>
            </div>
        </section>
    

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 Travel Buddy Matching Platform</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap dropdowns, modals, etc.) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
