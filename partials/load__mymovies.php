<?php
// include "./mysqli_connect.php";
include './preload.php';


session_start();
$out = '';
$email = $_SESSION['s_email'];
$query = "SELECT * FROM moviedetail WHERE movie__owner='$email'";
if ($result = mysqli_query($dbc, $query)) {
    while ($my__movie = mysqli_fetch_array($result)) {
        $out .= '
            <tr>
                <td class="movie__name border border-lightgrey" data-fid=' . $my__movie["FID"] . '>' . $my__movie["movie__name"] . '</td>
                <td class="genre border border-lightgrey" data-genreid=' . $my__movie["FID"] . '> ' . $my__movie["genre"] . '</td>
                <td class="release__time border border-lightgrey" data-releaseid=' . $my__movie["FID"] . '>' . $my__movie["release__time"] . '</td>
                <td class="text-center border border-lightgrey">
                    <form>
                        <input type="hidden" id="delete__movie__fid" value="' . $my__movie["FID"] . '">
                        <input type="hidden" id="delete__movie__background" value="' . $my__movie["background"] . '">
                        <input type="hidden" id="delete__movie__poster" value="' . $my__movie["poster"] . '">
                        <input type="hidden" id="delete__movie__link" value="' . $my__movie["link"] . '">
                        
                        <button type="button" class="btn btn-orange border-none" data-bs-toggle="modal" data-bs-target="#confrim__delete">
                            <i class="fas fa-trash"></i>
                        </button>

                        <div class="modal fade" id="confrim__delete" tabindex="-1" role="dialog" aria-labelledby="confrim__deleteTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content  bg-glass">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="confrim__delete__title">Delete movie?</h3>
                                        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times text-white"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>You want to delete "' . $my__movie["movie__name"] . '?"</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Close</button>
                                        <button data-delid="' . $my__movie["FID"] . '" data-bs-dismiss="modal" class="del__movie btn btn-orange" name="delete__movie" type="button">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            ';
    }
} else {
    $out .= '<tr>
                    <td colspan="4"></td>
                </tr>';
}
echo $out;
