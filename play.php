<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RSM Bingo | Play</title>
<meta name="description" content="" />

<link rel="stylesheet" type="text/css" href="media/css/reset.css" />
<link rel="stylesheet" type="text/css" href="media/css/main.css" />
<link rel="stylesheet" type="text/css" href="media/css/bingo.css" />

<script type="text/javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" src="media/js/render.js"></script>
<script type="text/javascript" src="media/js/fittext.js"></script>

<script type="text/javascript">
function CreateArr(n) {
    var a = new Array(n);
    for (var i = 0; i <= n; ++i) {
        a[i] = new Array(n);
        for (var j = 0; j <= n; ++j) {
            a[i][j] = 0;  
        }
    }
    return a;
}
function checkRes(a, n){
    // rows loop
    for (var i = 0; i <= n; i++) {
        r = 1;
        for (var j = 0; j <= n; j++) {
            if (a[i][j] === 0){
                r = 0;
            }
        }
        if (r === 1) { break; }
    }
    //console.log("row - r" + r);
    
    // columns loop
    if (r === 0){
        for (j = 0; j <= n; j++) {
            r = 1;
            for (i = 0; i <= n; i++) {
                if (a[i][j] === 0){
                    r = 0;
                }
            }
            if (r === 1) { break; }
        }
    }
    return r;
}

$(document).ready(function(){
    $('.cell').click(function(){
        $(this).toggleClass('highlighted');
        
        var n_rows = $('.bingo-table tr').length - 2;
        var x_arr = CreateArr(n_rows);
        
        $('.highlighted').each(function() {    
            var x_r = parseInt(this.id.charAt(1));
            var x_c = parseInt(this.id.charAt(2));
            x_arr[x_r][x_c] = 1;           
        });
        if (checkRes(x_arr, n_rows) === 1) { alert ("You won!"); }
        
    });    
    $(window).resize();
 });

$(window).resize(function(){
    //var height = $(window).height();
    var width = $(window).width();
    //var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    var offset = $('.cell:first').position().top + 10;  //offset from top
    var t_size = $('.bingo-table tr:last td').length;   //num of cols
    if (height > width){
        var size = parseInt(width / t_size);    
    }else{
        var size = parseInt((height-offset) / t_size);
    }
    console.log("w="+width+", h"+height);
    console.log("offset="+offset);
    console.log("size="+size);
    
    width = size; //*1.2;
    height = width * 0.85;

    $('.cell, .header').css("width", width + "px");
    $('.cell').css("height", height + "px");
    $('.bingo-table').css("width", width*t_size + "px");
    setFontSize();
    
    //set font size of title text to fit in one row
    //$("#titlethcell").fitText(1.6);
    //$("#titlethcell").fitText(1.1, { minFontSize: '12px', maxFontSize: '32px' });   
    var th_cell = document.getElementById('titlethcell');
    var fstyle = window.getComputedStyle(th_cell, null).getPropertyValue('font-size');
    var th_fsize = parseFloat(fstyle); 
    var tst_w = (document.getElementById("th-test").clientWidth + 1);
    var th_w = th_cell.offsetWidth;
    var fin_size = Math.ceil(((th_w / tst_w) * th_fsize)*0.9);
    th_cell.style.fontSize = fin_size + "px";
    //console.log("fsize=" + th_fsize + ", tst_w=" + tst_w + ", th_w=" + th_w + ", fs=" + fin_size);
});
</script>
</head>
<body>  
        
<?
    require 'vendor/autoload.php';
    //use Aws\S3\S3Client;
    //use Aws\S3\Exception\S3Exception;
    
    // Instantiate the client.
    $bucket = 'rsm-bingo';
    $s3 = new Aws\S3\S3Client(['region'  => 'eu-west-1','version' => 'latest']);

    if(isset($_GET["uid"])) {
        if (is_numeric($_GET['uid'])){$uid = $_GET['uid'];}
        if (isset($_GET['pname'])){ $pname = $_GET['pname'];} else { $pname = ""; }
        
        if ($s3->doesObjectExist($bucket, $uid . '.json') === TRUE){
            $res_s3 = $s3->getObject(array('Bucket'=>$bucket,'Key'=>$uid . '.json'));
            $Loaded_Data = json_decode($res_s3->get("Body"), true);    
               
            //Fill FORM_DATA var with data from _GET
            $FORM_DATA["name"] = $Loaded_Data["name"];
            $FORM_DATA["size"] = $Loaded_Data["size"];
            $FORM_DATA["word-0-0"] = $Loaded_Data["word-0-0"];
            $FORM_DATA["word-0-1"] = $Loaded_Data["word-0-1"];
            $FORM_DATA["word-0-2"] = $Loaded_Data["word-0-2"];
            $FORM_DATA["word-0-3"] = $Loaded_Data["word-0-3"];
            $FORM_DATA["word-0-4"] = $Loaded_Data["word-0-4"];
            $FORM_DATA["word-1-0"] = $Loaded_Data["word-1-0"];
            $FORM_DATA["word-1-1"] = $Loaded_Data["word-1-1"];
            $FORM_DATA["word-1-2"] = $Loaded_Data["word-1-2"];
            $FORM_DATA["word-1-3"] = $Loaded_Data["word-1-3"];
            $FORM_DATA["word-1-4"] = $Loaded_Data["word-1-4"];
            $FORM_DATA["word-2-0"] = $Loaded_Data["word-2-0"];
            $FORM_DATA["word-2-1"] = $Loaded_Data["word-2-1"];
            $FORM_DATA["word-2-2"] = $Loaded_Data["word-2-2"];
            $FORM_DATA["word-2-3"] = $Loaded_Data["word-2-3"];
            $FORM_DATA["word-2-4"] = $Loaded_Data["word-2-4"];
            $FORM_DATA["word-3-0"] = $Loaded_Data["word-3-0"];
            $FORM_DATA["word-3-1"] = $Loaded_Data["word-3-1"];
            $FORM_DATA["word-3-2"] = $Loaded_Data["word-3-2"];
            $FORM_DATA["word-3-3"] = $Loaded_Data["word-3-3"];
            $FORM_DATA["word-3-4"] = $Loaded_Data["word-3-4"];
            $FORM_DATA["word-4-0"] = $Loaded_Data["word-4-0"];
            $FORM_DATA["word-4-1"] = $Loaded_Data["word-4-1"];
            $FORM_DATA["word-4-2"] = $Loaded_Data["word-4-2"];
            $FORM_DATA["word-4-3"] = $Loaded_Data["word-4-3"];
            $FORM_DATA["word-4-4"] = $Loaded_Data["word-4-4"];
        }
        if ($pname == "") { $pname = "Noname"; }
    }
?> 
    
    <table class="bingo-table" id="tablebackground">
        <thead>
            <tr><th colspan="5" id="titlethcell">
                Game:
                <? print(" '" . $FORM_DATA["name"] . "'; "); ?>    
                Player:
                <? print($pname); ?>
            </th></tr>
        </thead>
        <tr>
            <td class="cell  " style="" id="w00"><? print($FORM_DATA["word-0-0"]); ?></td>
            <td class="cell  " style="" id="w01"><? print($FORM_DATA["word-0-1"]); ?></td>
            <td class="cell  " style="" id="w02"><? print($FORM_DATA["word-0-2"]); ?></td>
            <td class="cell  " style="" id="w03"><? print($FORM_DATA["word-0-3"]); ?></td>
            <td class="cell  " style="" id="w04"><? print($FORM_DATA["word-0-4"]); ?></td>
        </tr>                         
        <tr>                                    
            <td class="cell  " style="" id="w10"><? print($FORM_DATA["word-1-0"]); ?></td>                                    
            <td class="cell  " style="" id="w11"><? print($FORM_DATA["word-1-1"]); ?></td>                                    
            <td class="cell  " style="" id="w12"><? print($FORM_DATA["word-1-2"]); ?></td>
            <td class="cell  " style="" id="w13"><? print($FORM_DATA["word-1-3"]); ?></td>
            <td class="cell  " style="" id="w14"><? print($FORM_DATA["word-1-4"]); ?></td>
        </tr>
        <tr>
            <td class="cell  " style="" id="w20"><? print($FORM_DATA["word-2-0"]); ?></td>
            <td class="cell  " style="" id="w21"><? print($FORM_DATA["word-2-1"]); ?></td>
            <td class="cell  " style="" id="w22"><? print($FORM_DATA["word-2-2"]); ?></td>
            <td class="cell  " style="" id="w23"><? print($FORM_DATA["word-2-3"]); ?></td>
            <td class="cell  " style="" id="w24"><? print($FORM_DATA["word-2-4"]); ?></td>
        </tr>
        <tr>
            <td class="cell  " style="" id="w30"><? print($FORM_DATA["word-3-0"]); ?></td>
            <td class="cell  " style="" id="w31"><? print($FORM_DATA["word-3-1"]); ?></td>
            <td class="cell  " style="" id="w32"><? print($FORM_DATA["word-3-2"]); ?></td>
            <td class="cell  " style="" id="w33"><? print($FORM_DATA["word-3-3"]); ?></td>
            <td class="cell  " style="" id="w34"><? print($FORM_DATA["word-3-4"]); ?></td>
        </tr>
        <tr>
            <td class="cell  " style="" id="w40"><? print($FORM_DATA["word-4-0"]); ?></td>
            <td class="cell  " style="" id="w41"><? print($FORM_DATA["word-4-1"]); ?></td>
            <td class="cell  " style="" id="w42"><? print($FORM_DATA["word-4-2"]); ?></td>
            <td class="cell  " style="" id="w43"><? print($FORM_DATA["word-4-3"]); ?></td>
            <td class="cell  " style="" id="w44"><? print($FORM_DATA["word-4-4"]); ?></td>
        </tr>
    </table>
    <div id="additional-set">
        <a href="/">Back to the main page</a><br>
        
        <script type="text/javascript">
            //var t_w = document.getElementById('tablebackground').offsetWidth;
            //var c_w = document.getElementById('w00').offsetWidth;
            //var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
            //var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
            
            //document.write(t_w + ", " + c_w + ", " + w + ", " + h + ", ");
        </script>
    </div>

<div id="hidden">
    <!-- used to get the CSS info, so don't put anything in here -->
    <div id="has-cell" class="cell "></div>
    <!-- used to test if the text overflows the textarea -->
    <textarea id="height-test" class="cell "></textarea>
    <!-- used to test if a single word overflows -->
    <span id="width-test" class="cell "></span>
</div>
    
<div id="th-test">
    Game:
    <? print(" '" . $FORM_DATA["name"] . "'; "); ?>    
    Player:
    <? print($pname); ?>
</div>                
 
<script type="text/javascript">
    //var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var width = $(window).width();
    var height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    var offset = $('.cell:first').position().top + 10;  //offset from top
    var t_size = $('.bingo-table tr:last td').length;   //num of cols
    if (height > width){
        var size = parseInt(width / t_size);    
    }else{
        var size = parseInt((height-offset) / t_size);
    }
    document.write("w="+width+", h"+height+", offset="+offset+", size="+size);
</script>
    
</body>
</html>