<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo Test</title>
<meta name="description" content="Bingo card game"/>
<link rel="stylesheet" type="text/css" href="media/css/reset.css" />

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
#tablebackground {
    background: rgb(118,214,255); /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* For Firefox 3.6 to 15 */
    background: linear-gradient(rgb(00,84,147), rgb(118,214,255)); /* Standard syntax */
}

.index-title {
    margin: auto; 
    //border-collapse: separate;
    //border-spacing: 1% 1%;
    width: 100%;
    //min-width: 500px;
    //max-width: 800px;
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