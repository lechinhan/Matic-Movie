<?php
// include './mysqli_connect.php';
include './preload.php';


$FID = $_POST['FID'];
$query = "SELECT * FROM moviedetail where FID = $FID";
if ($result = mysqli_query($dbc, $query)) {
    while ($row = mysqli_fetch_array($result)) {
        $htmlspecialchars =  'htmlspecialchars';
        $link = './movies/480k_dmg.mp4';
?>
        <div class="row">
            <h2 style="color: #FFA500; padding-left: 6%;"> <?php echo $row['movie__name'] ?></h2>
        </div>
        <hr>
        <!-- <iframe id="video_watching" class="w__video" src="https://www.youtube.com/embed/0fCcWOr9GAo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        <!-- <iframe id="video_watching" class="w__video" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        <div class="row mb-3">
            <!-- <video controls id="video_watching" class="w__video">
                <source src="" type="video">
            </video> -->
            <iframe id="video_watching" class="w__video" src="https://www.youtube.com/embed/4Ps6nV4wiCE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <script>
            $(function() {
                var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                width *= 0.75;
                $(".w__video").css("width", width + "px");
                $(".w__video").css("height", (width * 0.5625) + "px");
            });
        </script>
        <hr>
        <div class="row" id="w__description">
            <div class="col-8 h-100 descript__inner">
                <h2 class="descript__title"> <?php echo $row['movie__name'] ?></h2>
                <div class="descript__body">
                    <div class="other__film__rate w-100 row mb-1 align-items-center">
                        <div class="col-1">
                            <i class="fas fa-star" style="color: yellow;"></i>
                            <span class="other__rate__point">
                                <?php echo $row["rating"]; ?>
                            </span>
                        </div>
                        <span class="col-2 other__film__quality fw-bold col-xl-2 text-center">
                            <?php echo $row["quality"]; ?>
                        </span>
                        <span class="other__film__duration col-xl-2 col-md-6 col-7">
                            <i class="fas fa-clock"></i>
                            <?php echo $row["duration"]; ?> min
                        </span>
                    </div>
                    <div class="row">
                        <p> <strong style="color: #FFA500"> Genre:</strong> <?php echo $row['genre'] ?> </p>
                    </div>
                    <div class="row">
                        <p> <strong style="color: #FFA500">Casts:</strong> <?php echo $row['casts'] ?>' </p>
                    </div>
                    <div class="row">
                        <p> <strong style="color: #FFA500"> Overview:</strong> <?php echo $row['overview'] ?></p>
                    </div>

                </div>
            </div>
            <div class="col-2 h-100">
                <img src="<?php echo $row['poster'] ?>" class="img-fluid rounded-3" alt="...">
            </div>
        </div>
        <hr>

        <div class="row mb-3" id="w__servers">
            <p> Film's Server </p>
            <span>The server changing buttons are pretty useless at the moment. We are trying to bring it back in the next patch. Stay tuned &#128517;&#128517;</span>
            <div class="col-12 justify-content-center d-flex">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group" id="w__server_ratio">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    <label class="btn btn-outline-orange" for="btnradio1">Server 1</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-orange" for="btnradio2">Server 2</label>
                </div>
            </div>
        </div>
        <hr>
<?php
    }
}
?>