<?php

// include_once './mysqli_connect.php';
include './preload.php';


$output = '';
$sql = "SELECT * FROM moviedetail WHERE (movie__name LIKE '%" . $_POST['data'] . "%')";
// OR (genre LIKE '%" . $_POST['data'] . "%')
// OR (casts  LIKE '%" . $_POST['data'] . "%')";
if ($result = mysqli_query($dbc, $sql)) {
    if (mysqli_num_rows($result)) {
        $output .= '<div class="row search_box_header">
                        <div class="col-3"><strong>Movie Name</strong></div>
                        <div class="col-4"><strong>Genre</strong></div>
                        <div class="col-5"><strong>Casts</strong></div>
                    </div>';
    } else {
        echo "<p class='mt-2 row'><strong> Data not found </strong> </p>";
    }
    $count = 0;
    while ($row = mysqli_fetch_array($result)) {
        $m__name = $row['movie__name'];
        $genre = $row['genre'];
        $casts = $row['casts'];
        $FID = $row['FID'];
        $output .= '<form onfocusout="dismiss__search_box()" class="row search_box_result" tabindex="200" method="POST" action="./watch.php" style="position: relative;">
                        <input type="hidden" name="FID" value="' . $FID . '">
                        <div class="col-3" style="font-size: 17px;"><strong>' . $m__name . '</strong></div>
                        <div class="col-4"> ' . $genre . '</div>
                        <div class="col-5">' . $casts . '</div>
                        <button type="submit" tabindex="1" class="btn row__search_button"> </button>
                    </form>
                     ';
    }
    echo $output;
} else {
    echo "<p> Something went wrong!!! </p>";
}

// <form method='POST' action='./watch.php' style='position: relative;'> 
// <input type='hidden' name='FID' value='" . $row['FID'] . "'>
// <button type='submit' class='btn row__search_button'> </button>
// </form>
// $output .= '<form><tr>
// <th scope="row">' . $m__name . '</th>
// <td>' . $genre . '</td>
// <td>' . $casts . '</td> 
// <td style="display:none;"> 
// <form method="POST" action="./watch.php" style="position: relative;">
// <input type="hidden" name="FID" value="' . $FID . '">
// <button type"submit" class="btn row__search_button">fewfèwed </button>
// </form>
// </td>
// </tr></form>';