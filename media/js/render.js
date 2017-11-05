    function setFontSize(){
    // the demo element is an empty element with the proper CSS class
    var demo = $('#has-cell');
    var WIDTH = parseInt(demo.css('width'));
    var HEIGHT = parseInt(demo.css('height'));
    var FONT_SIZE = parseInt(demo.css('font-size'));

    // we need two elements to detect overflowing text in the horizontal and vertical directions
    var height_test = document.getElementById("height-test");
    var $height_test = $("#height-test");
    var $width_test = $("#width-test");

    // we do a binary search to find the right font-size
    var binary_iters = Math.ceil(Math.log(FONT_SIZE) / Math.log(2)) + 1;

    // cache the results so we don't have to do the heavy calculations again
    var cache = {};

    // for each cell, change its font size to the largest it can be without overflowing
    var elements = $("table .cell");
    for(var i = 0; i < elements.length; i++){
        var $element = $(elements[i]);
        var id = parseInt($element.attr('id').substr(1))
        if(id in cache){
            $element.css('font-size', cache[id] + "px");
            continue;
        }

        var font_size = FONT_SIZE;
        var delta = Math.floor(FONT_SIZE / 2.0);
        // set the text on the two testing elements
        $height_test.val($element.text());
        $width_test.text(getLongestWord($element));
        
        for(var j = 0; j < binary_iters; j++){
            // for some reason, IE needs this reset on each iteration
            $height_test.val($element.text());

            // change the font size and check if it overflows
            $height_test.css('font-size', font_size + "px");
            $width_test.css('font-size', font_size + "px");
            var overflows = hasScrollbar(height_test) || $width_test.outerWidth() > WIDTH;
            if(overflows){
                font_size -= delta;
            } else if(j == binary_iters - 1) {
                // we didn't overflow on the last iteration, which means we hit the right value
                // so don't increase the font size again
                break;
            } else {
                font_size += delta;
            }
            delta = Math.ceil(delta / 2.0);
        }
        // the Math.min makes sure that we don't get larger than the default font size
        // take it out if you want your font size to expand too
        font_size = Math.min(font_size, FONT_SIZE);
        $element.css('font-size', font_size + "px");
        cache[id] = font_size;
    }
}

function getLongestWord($element){
    var words = $element.text().split(/\s+/);
    var longest_word = words[0];
    for(var i = 1; i < words.length; i++){
        if(words[i].length > longest_word.length)
            longest_word = words[i];
    }
    return longest_word;
}

function hasScrollbar(element){ 
    return element.clientHeight < element.scrollHeight;
}  