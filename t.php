<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo Test</title>
<meta name="description" content="Bingo card game"/>
<link rel="stylesheet" type="text/css" href="media/css/reset.css" />
<link rel="stylesheet" type="text/css" href="media/css/bingo.css" />

<style type="text/css">
body {
    font-family:Din;
}
h1 {
    font-size:28px;
    font-family:Avenir;
    margin-bottom:5px;
}
h2 {
    margin-bottom:5px;
    font-family:Din;
    font-size:18px;
}

</style>
</head>
    
    
<body>
<div class="index-title" id="tablebackground">
    RSM Bingo Game
    <div class="celltitle" id="celltitle-play">
        <h1>Play</h1>
        <form action="play.php" method="get" id="play-form">
            <h2>
                Game ID: <input type='text' size=6 name='uid' value='' maxlength="6" placeholder="Game ID" /> <br>
                Name: <input type='text' size=13 name='pname' value='' maxlength="16" placeholder="Your name" /></h2>
            <input type="submit" name="p" value="Play" id="submit" />
        </form>
    </div>
    <div class="celltitle" id="celltitle-load">
        <h1>Edit</h1>
        <h2>Edit existing games</h2>
        <form action="edit.php" method="get" id="load-form">    
            <input type='text' name='uid' size=6 value='' maxlength="6" placeholder="Game ID" />
            <input type="submit" name="l" value="Load" id="submit" />
        </form>
    </div>
    <div class="celltitle" id="celltitle-new">
        <td class="celltitle">      
            <h1>Cards</h1>
            <h2>Create a new game
                <form method="get" action="/edit.php">
                    <button type="submit" id="submit">New game</button>
                </form>
            </h2>
    </div>
    <div class="celltitle">
        <td class="celltitle">  
            <h1>The best games</h1>    
            <h2><a href="#">1</a></h2>
            <h2><a href="#">2</a></h2>
            <h2><a href="#">3</a></h2>
            <h2><a href="#">4</a></h2>
            <h2><a href="#">5</a></h2>
            
            <?
            //require 'vendor/autoload.php';
            //use Aws\S3\S3Client;
            //use Aws\S3\Exception\S3Exception;
            
            // Instantiate the client.    
            //$bucket = 'rsm-bingo';
            //$configfile = 'config.json';
            //$s3 = new Aws\S3\S3Client(['region'  => 'eu-west-1','version' => 'latest']);
            
            //Use the high-level iterators (returns ALL of your objects).
            //try { $objects = $s3->getIterator('ListObjects', array('Bucket' => $bucket));
            //    foreach ($objects as $object) {
            //        echo "<h2>" . $object['Key'] . "\n</h2>";
            //    }
            //} catch (S3Exception $e) { echo $e->getMessage() . "\n"; }
            
            ?>
        </div>
    &nbsp;
</div>
    
    <div align="center">
        <script type="text/javascript">
            var tablebackground_width = document.getElementById('tablebackground').offsetWidth;
            var celltitle_width = document.getElementById('celltitle-play').offsetWidth;
            var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
            var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

            document.write('tablebackground width=' + tablebackground_width + "<br>");
            document.write('celltitle-play width=' + celltitle_width + "<br>");
            document.write('screen width=' + w + ', height=' + h);
        </script>
    </div>

</body>
</html>