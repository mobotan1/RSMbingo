<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo</title>
<meta name="description" content="Bingo card game"/>

<link rel="stylesheet" type="text/css" href="media/css/reset.css" />
<link rel="stylesheet" type="text/css" href="media/css/main.css" />
<link rel="stylesheet" type="text/css" href="media/css/bingo.css" />
</head>
    
<body>
<div class="index-title" id="tablebackground">&nbsp;
    <div class="celltitle">
        <h1>Play</h1>
        <form action="play.php" method="get" id="play-form">
            <input type='text' size=5 name='uid' value='' maxlength="6" placeholder="Card ID" /> <br>
            <input type='text' size=13 name='pname' value='' maxlength="16" placeholder="Your name" />
            <input type="submit" name="p" value="Play" id="submit" />
        </form>
    </div>
    <div class="celltitle">
        <h1>Edit</h1>
        <h2>You can edit existing cards</h2>
        <form action="edit.php" method="get" id="load-form">    
            <input type='text' name='uid' size=6 value='' maxlength="6" placeholder="Card ID" />
            <input type="submit" name="l" value="Load" id="submit" />
        </form>
    </div>
    <div class="celltitle">
        <td class="celltitle">      
            <h1>Cards</h1>
            <h2>You can create your own brand new card
                <form method="get" action="/edit.php">
                    <button type="submit" id="submit">New card</button>
                </form>
            </h2>
    </div>
    <div class="celltitle">
        <td class="celltitle">  
            <h1>The best cards</h1>    
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

</body>
</html>