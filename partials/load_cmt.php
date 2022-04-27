<?php
// include './mysqli_connect.php';
include './preload.php';


date_default_timezone_set('Asia/Ho_Chi_Minh');

$FID = $_POST['FID'];
$sql = "SELECT * FROM comments WHERE FID = '$FID' ORDER BY CID DESC";
// $sql = "SELECT * FROM comments WHERE FID = '$FID' ORDER BY CID DESC ";
$result = mysqli_query($dbc, $sql);
while ($row = mysqli_fetch_array($result)) {
    $email = $row['email'];
    $name_query = "SELECT firstName FROM userinfo u 
                            INNER JOIN comments c ON u.email = c.email
                            WHERE u.email = '$email' LIMIT 1";
    if ($name_result = mysqli_query($dbc, $name_query)) {
        if ($name_row = mysqli_fetch_array($name_result)) {
            $name_displayed = $name_row['firstName'];
        } else {
            $name_displayed = $row['email'];
        }
    }
    $htmlspecialchars =  'htmlspecialchars';
    $msg = $htmlspecialchars($row['msg']);


    //Usage :
    $difference = timeDiff($row['cmt_date'], date("Y-m-d H:i:s"));
    $years = floor($difference / 31536000);
    $days = floor(($difference - ($years * 31536000)) / 86400);
    $hours = floor(($difference - ($years * 31536000) - ($days * 86400)) / 3600);
    $mins = floor(($difference - ($years * 31536000) - ($days * 86400) - ($hours * 3600)) / 60); #floor($difference / 60);
    if ($mins == 0) {
        $cmt_time = '1m';
    } else {
        $cmt_time = $mins . 'm ';
    }
    if ($hours != 0) {
        $cmt_time = $hours . 'h ' . $cmt_time;
    }
    if ($days != 0) {
        $cmt_time = $days . 'd ';
    }
    if ($years != 0) {
        $cmt_time = $years . 'y ';
    }

?>
    <div class="row w__cmt mt-1" id="<?php echo $row['CID']; ?>">
        <div class="col-12 cmt__header align-item-center">
            <span class="cmt__name"> <?php echo $name_displayed ?> </span>
            <span class="cmt__time"> <?php echo $cmt_time ?> ago</span>
        </div>
        <div class="col-12 cmt__body">
            <span><?php echo $row['msg'] ?> </span>
        </div>
        <script>

        </script>
        <?php
        if (isset($_POST['isLogged'])) {
            if (($_POST['isLogged'] == 1) && ($_POST['email'] == $email)) {
        ?>
                <div class="col-12 cmt__footer">
                    <button type="button" onclick="del_cmt(<?php echo $row['CID'] ?>)">Delete</button>
                    <button type="button" onclick='show_edit_box("<?php echo $row["CID"]; ?>", "<?php echo $msg ?>")'>Edit</button>
                </div>
                <form method="post" action="#" class="col-12" style="position: relative;" id="cmt_edit_<?php echo $row['CID']; ?>">
                    <input type="hidden" id="edit_CID_<?php echo $row['CID']; ?>" value="<?php echo $row['CID']; ?>">
                </form>
        <?php
            }
        } ?>

    </div>

<?php }
function timeDiff($firstTime, $lastTime)
{
    // convert to unix timestamps
    $firstTime = strtotime($firstTime);
    $lastTime = strtotime($lastTime);
    // perform subtraction to get the difference (in seconds) between times
    $timeDiff = $lastTime - $firstTime;
    // return the difference
    return abs($timeDiff);
}

?>