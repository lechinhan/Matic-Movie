<?php
    include "./partials/header.php";
    $genre = $_POST["genre"];
    echo '<div class="container-fluid over__container">
        <div id="main" class="bg-lighter-dark mx-2" style="text-align: justify; color: #8E95A5;">
            <h2 class="text-center"></h2>
            <div class="trending col-12 "> 
                <div class="row mb-5 justify-content-center">
                    <div class=" my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,transparent, transparent, rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8)); "></div>
                    <h4 class="my-auto col-auto text-uppercase p-1 text-center">
                        RESULT FOR '.$genre.' MOVIE
                    </h4>
                    <div class="my-auto col-auto w-100" style="height: 3px; background-image: linear-gradient(90deg,rgba(255, 126, 0, 1),rgba(255, 126, 0, 0.8),transparent, transparent ); "></div>
                </div>
                <div id="search__body" class="row">';
                        $search__genre__query="SELECT * FROM moviedetail WHERE genre LIKE '%".$genre."%'";
                        if ($result = mysqli_query($dbc, $search__genre__query)) {
                    
                            while ($search__genre__array = mysqli_fetch_array($result)) {
                                $htmlspecialchars = 'htmlspecialchars';
                                if($search__genre__array["quality"] != "NA"){
                                    echo '
                                    <div class="mb-4 col-xl-2 col-md-3 col-sm-4 col-6 d-flex flex-column">
                                        <div class="row bg-dark-blue m-0">
                                            <img class="col-12 p-0 mb-2" src="'.$htmlspecialchars($search__genre__array["poster"]).'" alt="" style="aspect-ratio: 2 / 3;">
                                            <div class=" text-lightgrey fs-8 col-12">
                                                <div class="row mb-1">
                                                    <span class="col-4">
                                                        <i class="fas fa-star rate__star" style="color: yellow;"></i>
                                                        <span class="">
                                                            '.$search__genre__array["rating"].'
                                                        </span>
                                                    </span>
                                                    <span class="col-2 fw-bold text-center">
                                                    '.$search__genre__array["quality"].'
                                                    </span>
                                                    <span class=" col-6 d-block text-end">
                                                        <i class="fas fa-clock"></i>
                                                        <span class="">
                                                        '.$search__genre__array["duration"].' min
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class=" row text-white mt-2 mb-3">
                                                    <h6 class="d-block" style="white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    '.$search__genre__array["movie__name"].'
                                                    </h6>
                                                </div>
                                                <div class="row mb-2 d-none">
                                                    <span class="d-block" style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                        <span class="fw-bold">Genre: </span>
                                                    <span class="">
                                                    '.$search__genre__array["genre"].'
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class=" row mb-2 d-none">
                                                    <span>
                                                        <span class="fw-bold">Release: </span>
                                                    <span class="">'.$search__genre__array["release__time"].'</span>
                                                    </span>
                                                </div>
                                                <div class=" d-none row mb-2">
                                                    <span class="d-block " style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                        <span class="fw-bold">
                                                            Casts:
                                                        </span>
                                                    <span class="">
                                                        '.$search__genre__array["casts"].'
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class=" row my-2 justify-content-center">
                                                    <form action="./watch.php" method="post" class="text-center">
                                                        <input type="hidden" name="FID" value="'.$search__genre__array["FID"].'" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                        <button type="submit" class="trending__play__button col-11 btn btn-orange fs-8" style="border-radius: 4px;">
                                                            <i class="fas fa-play-circle p-1"></i>Watch now
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }else {
                                    echo '
                                    <div class="mb-4 col-xl-2 col-md-3 col-sm-4 col-6 d-flex flex-column">
                                        <div class="row bg-dark-blue m-0">
                                            <img class="col-12 p-0 mb-2" src="'.$htmlspecialchars($search__genre__array["poster"]).'" alt="" style="aspect-ratio: 2 / 3;">
                                            <div class=" text-lightgrey fs-8 col-12">
                                                <div class="row mb-1">
                                                    <span class="col-4">
                                                        <i class="fas fa-star rate__star" style="color: yellow;"></i>
                                                        <span class="">
                                                            '.$search__genre__array["rating"].'
                                                        </span>
                                                    </span>
                                                    <span class="col-2 fw-bold text-center">
                                                    '.$search__genre__array["quality"].'
                                                    </span>
                                                    <span class=" col-6 d-block text-end">
                                                        <i class="fas fa-clock"></i>
                                                        <span class="">
                                                        '.$search__genre__array["duration"].' min
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class=" row text-white mt-2 mb-3">
                                                    <h6 class="d-block" style="white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                    '.$search__genre__array["movie__name"].'
                                                    </h6>
                                                </div>
                                                <div class="row mb-2 d-none">
                                                    <span class="d-block" style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                        <span class="fw-bold">Genre: </span>
                                                    <span class="">
                                                    '.$search__genre__array["genre"].'
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class=" row mb-2 d-none">
                                                    <span>
                                                        <span class="fw-bold">Release: </span>
                                                    <span class="">'.$search__genre__array["release__time"].'</span>
                                                    </span>
                                                </div>
                                                <div class=" d-none row mb-2">
                                                    <span class="d-block " style=" white-space: nowrap; width: 95%; overflow: hidden; text-overflow: ellipsis; ">
                                                        <span class="fw-bold">
                                                            Casts:
                                                        </span>
                                                    <span class="">
                                                        '.$search__genre__array["casts"].'
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class=" row my-2 justify-content-center">
                                                    <form action="./watch.php" method="post" class="text-center">
                                                        <input type="hidden" name="FID" value="'.$search__genre__array["FID"].'" class="play__button w-50 btn btn-orange" style="border-radius: 50px;">
                                                        <button type="submit" disabled class="trending__play__button col-11 btn btn-orange fs-8" style="border-radius: 4px;">
                                                            <i class="fas fa-play-circle p-1"></i>Watch now
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        } else {
                            echo '<p class="error">Cannot load data because:<br>' . mysqli_error($dbc) .
                                    '.</p><p>Query is: ' . $search__genre__query . '</p>';
                        }
                echo '
                </div>
            </div>
        </div>
    </div>';

    include "./partials/footer.php";
?>