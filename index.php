<?php
/* https://packagist.org/packages/hubspot/api-client */
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.hubapi.com/crm/v3/objects/deals?limit=20&archived=false&hapikey=",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 20,
    CURLOPT_TIMEOUT => 50,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "accept: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
}

//$deals = array();
$deals = json_decode($response, true);
$pipeline = [];
if ($pipeline == 0) {
    $pipeline = 'default';
} else {
    $pipeline = $_GET["pipeline"];
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Sepio Systems</title>
</head>
<body>
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Amount</th>
            <th scope="col">Close Date</th>
            <th scope="col">Create Date</th>
            <th scope="col">Deal Name</th>
            <th scope="col">Deal Stage</th>
            <th scope="col">Pipeline</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($response != '') {
            foreach ($deals['results'] as $deal => $value) {
                if ($deals['results'][$deal]['properties']['pipeline'] == $pipeline) {
                ?>
                <tr>
                    <td><?php echo $deals['results'][$deal]['id']; ?></td>
                    <td><?php echo $deals['results'][$deal]['properties']['amount']; ?></td>
                    <td><?php echo $deals['results'][$deal]['properties']['closedate']; ?></td>
                    <td><?php echo $deals['results'][$deal]['properties']['createdate']; ?></td>
                    <td><?php echo $deals['results'][$deal]['properties']['dealname']; ?></td>
                    <td><?php echo $deals['results'][$deal]['properties']['dealstage']; ?></td>
                    <td><?php echo $deals['results'][$deal]['properties']['pipeline']; ?></td>
                </tr>
                <?php
                }
            }
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>


