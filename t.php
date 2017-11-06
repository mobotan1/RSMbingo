<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo Test</title>
<meta name="description" content="Bingo card game"/>
<link rel="stylesheet" type="text/css" href="media/css/reset.css" />
<link rel="stylesheet" type="text/css" href="media/css/main.css" />

<style type="text/css">
table.bingo-table {
    margin: auto; 
    border-collapse: separate;
    border-spacing: 8px 8px;
    width: 750px;
}
.bingo-table th {
    font-family:Avenir;
    font-size:32px;
    color: white;
    background-color:transparent;
    padding-top:5px;
    padding-bottom:5px;
}
.bingo-table td, .bingo-table th {
    border-collapse:collapse;
    text-align:center;
    vertical-align:bottom;
    border:none;
}
.bingo-table td.cell {
    border:1px solid black;
    vertical-align:middle;
    padding-bottom:0px;
}
.cell {
    font-family:Din;
    font-size:32px;
    cursor:pointer;
    width: 150px;
    height:150px;
    background-color:#fff;
}
.enlarged {
    font-size:130px;
}

#height-test, #width-test {
    padding:6px; /* adjust to make text fit in box without touching border */
}

#height-test {
    overflow:hidden;
}

#hidden {
    position:absolute;
    top:-5000px;
}

.highlighted {
    box-shadow: inset 0 0 0 1000px rgba(0, 150, 255, .9);
}

#additional-set {
    text-align:center;
    border-top:1px solid black;
    border-bottom:1px solid black;
    padding:5px;
    font-weight:bold;
}

#instructions {
    float:right;
    width:250px;
    border:5px solid rgb(118,214,255);
    /*background-color:#ffc301;*/
    padding:15px;
    border-radius:10px;
}

#instructions input, #instructions select {
    font-size:14px;
}

#instructions h1 {
    margin-bottom:10px;
    margin-top:20px;
}

#instructions h1:first-of-type {
    margin-top:0px;
}

#instructions p {
    margin-bottom:10px;
}

#submit {
    background-color:rgb(118,214,255);
    font-size:18px;
    color:#000;
    font-family:Avenir;
    border:none;
    display:block;
    margin:auto;
    padding:5px;
    margin-top:10px;
    border-radius:10px;
    text-align:center;
    margin-bottom:10px;
}

.index-title {
    margin: auto; 
    //border-collapse: separate;
    //border-spacing: 1% 1%;
    width: 100%;
    //min-width: 500px;
    max-width: 800px;
    height: 100%;
    text-align: center;
    font-family:Avenir;
    font-size:32px;
    //padding: 1%;
    color: white;
}
.celltitle{
    //margin: 1% 3% 1% 3%;
    margin: 1% auto; 
    text-align: center;
    vertical-align: middle;
    font-family:Avenir;
    font-size:24px;
    min-width: 80%;
    max-width: 90%;
    //width: 90%;
    min-height: 5em; //25%;  
    background-color:#fff; 
    border:2px solid black;
    padding:5px;
    border-collapse:collapse;
    color: rgb(00,84,147);
    //border-radius:2px;
}

#tablebackground {
    background: rgb(118,214,255); /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Firefox 3.6 to 15 */
    background: linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* Standard syntax */
}
::-webkit-input-placeholder {
   text-align: center;
}
:-moz-placeholder { /* Firefox 18- */
   text-align: center;  
}
::-moz-placeholder {  /* Firefox 19+ */
   text-align: center;  
}
:-ms-input-placeholder {  
   text-align: center; 
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