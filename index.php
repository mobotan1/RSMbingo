<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo Game</title>
<meta name="description" content="Bingo card game"/>

<style type="text/css">

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    line-height: 1;
}

h2{
    font-family:Din;
    font-size:24px;
}

table.bingo-table {
    margin: auto; 
    border-collapse: separate;
    border-spacing: 10px 10px;
    margin-bottom:30px;
    width: 750px;
}

.bingo-table th {
    font-family:Avenir;
    font-size:32px;
    color: white;
    padding-bottom:10px;
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
    /* 75 for 4x4*/
    /* 90 for 1x2 */
    /* 150 for 1x1 */
    width: 750px;
    height:100px;
    background-color:#fff;
}

.bingo-table th {
    padding-top:10px;
    padding-bottom:10px;
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
    margin-top:20px;
    border-radius:10px;
    text-align:center;
}

#tablebackground {
    background: red; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Firefox 3.6 to 15 */
    background: linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* Standard syntax */
}
</style>
</head>
    
<body>
<table class="bingo-table" id="tablebackground">
    <tr>
        <th class="celltitle">
            <h1>Play</h1>
            <form action="play.php" method="get" id="play-form">
                <h2>Game ID number: <input type='text' size=6 name='uid' value='' /></h2>
                <h2>Your name: <input type='text' size=11 name='pname' value='' /></h2>
                <input type="submit" name="p" value="Play" id="submit" />
            </form>
        </th>
    </tr>
    <tr>
        <td class="cell">
            <h1>Edit</h1>
            <h2>You can edit existing cards</h2>
            <form action="edit.php" method="get" id="load-form">    
                <h2>Type your game ID number: 
                    <input type='text' name='uid' size=6 value='' />
                    <input type="submit" name="l" value="Load" id="submit" />
                </h2>
            </form>
         </td>
    </tr>
    <tr>
        <td class="cell">      
            <h1>Cards</h1>
            <h2><a href="edit.php">Create a new card here</a></h2>
        <td>
    </tr>
    <tr>
        <td class="cell">  
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
        </td>
    </tr>
</table>

</body>
</html>