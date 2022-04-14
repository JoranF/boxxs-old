<?php

require_once 'db.php';

$db = new db();
$dbh = $db->connect();

$sql = 'SELECT t1.name AS team1, t2.name AS team2, match.play_date AS play_date, st.name AS state
    FROM match
    JOIN team AS t1 ON team1_id = t1.id
    JOIN team AS t2 ON team2_id = t2.id
    JOIN state AS st ON state_id = st.id';

$sth = $dbh->prepare($sql);
$sth->execute();

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0,user-scalable=yes" />
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keyword" content="voetbaltoernooi">
        <meta name="description" content="voetbaltoernooi">
        <meta name="author" content="Ramon & Joran">
        <meta name="copyright" content="(C) 2022">
        
        <title>Voetbaltoernooi</title>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <div class="container-fluid">
                <h1>Voetbalvereniging Rapiditas uit De Kraats</h1>
            </div>
        </header>
        
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="overview.php">Overzicht</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Teams</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Wedstrijden</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Uitslagen</a></li>
                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">hallo</a></li>
                </ul>
            </div>
        </nav>
        
        <section>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Team 1</th>
                            <th scope="col">Team 2</th>
                            <th scope="">Play date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $sth->fetch())
                                print '<tr>
                                    <td>' . $row['team1'] . '</td>
                                    <td>' . $row['team2'] . '</td>
                                    <td>' . $row['play_date'] . '</td>
                                    <td>' . $row['state'] . '</td>
                                </tr>';
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
