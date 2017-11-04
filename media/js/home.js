$(document).ready(function(){
    $('textarea').one("focus", function(){
        setTimeout(function(){
            $(this).select();
        }.bind(this), 1);
    });


    $('#more-link').click(function(){
        $('#more').slideDown('slow');
        $('#more textarea').focus()
        $(this).parent().remove();
        return false;
    });

    if($('#more textarea').val() != ""){
        $('#more-link').click();
    }

    $('#clear-link a').click(function(){
        $('.card textarea').val("");
        $('.card textarea').css("background-image", "")
        $('.card textarea').css("background-image", "")
        $('.card input[type="hidden"]').val("");
        $('input[type=text]').val("");
        $('input[name=name]').focus()
        return false;
    });

    getCurrentSize = function(){
        return $(".card tbody tr:first td").length;
    }

    var total_extra_rows = 0;
    $('#add-another-row').click(function(e){
        e.preventDefault();
        var count = $('.card textarea').length + getCurrentSize()
        rebuildGrid(getCurrentSize(), count)
    })

    function rebuildGrid(new_size, min_count){
        // get all the text and images in the cells
        var cells = [];
        var length = Math.max($(".card tbody td").find("textarea").length, $(".card tbody td").find("input").length)
        for(var i = 0; i < length; i++){
            cells.push({
                word: null,
                url: null
            });
        }

        $(".card tbody td").find("textarea").each(function(i, el){
            cells[i].word = $(this).val()
        });

        $(".card tbody td").find("input").each(function(i, el){
            cells[i].url = $(this).val()
        });

        // move the free space to the right spot
        var original_size = $(".card tbody tr:first td").length;
        var center_index = Math.floor(original_size*original_size/2);
        var center_cell = cells[center_index];
        cells.splice(center_index, 1);
        var new_center_index = Math.floor(new_size*new_size/2);
        cells.splice(new_center_index, 0, center_cell);

        // trim empty rows. We only care about trimming rows past the normal grid size.
        var trimmed_cells = cells.slice(0, new_size*new_size);
        for(var i = trimmed_cells.length; i < cells.length; i += new_size){
            // we don't care about empty rows in the normal grid
            var is_row_empty = true;
            for(var c = 0; c < new_size; c++){
                is_row_empty &= cells[i+c] ? (cells[i+c].url == "" && cells[i+c].word == "") : true
            }

            if(!is_row_empty){
                for(var c = 0; c < new_size; c++){
                    trimmed_cells.push(cells[i+c]);
                }
            }
        }
        cells = trimmed_cells;

        // ensure we have enough rows for the min_count
        while(cells.length < min_count){
            for(var c = 0; c < new_size; c++){
                cells.push(null);
            }
        }

        // start rebuilding the table
        $(".card tbody tr").remove();
        var $tbody = $(".card tbody");

        var number_of_rows = Math.max(new_size, Math.ceil(cells.length / new_size));
        for(var r = 0, extra_row_index = -new_size*new_size, i = 0; r < number_of_rows; r++){
            // add in the "extra rows/image" UI row
            if(r == new_size){
                $tbody.append("<tr><td colspan='" + new_size + "' class='extra-words'>Extra Words/Images</td></tr>");
            }

            $tr = $("<tr>");
            $tbody.append($tr);

            for(var c = 0; c < new_size; c++, i++, extra_row_index++){
                var cell = cells[i] || {
                    word: "",
                    url: ""
                }
                var replacements = {
                    _word_id_: r < new_size ? ("word-" + r + "-" + c) : ("word-" + extra_row_index),
                    _img_id_: r < new_size ? ("img-" + r + "-" + c) : ("img-" + extra_row_index),
                    _word_val_: cell.word,
                    _url_: cell.url,
                    _bg_image_: cell.url ? "url('" + cell.url + "')": "none"
                }

                var html = '<td>\
                    <textarea name="_word_id_" class="has-image" style="background-image:_bg_image_">_word_val_</textarea>\
                    <input name="_img_id_" class="img" type="hidden" value="_url_">\
                </td>';
                for(var k in replacements){
                    html = html.replace(k, replacements[k]);
                }

                $tr.append(html);
            }
        }
    }

    $('#id_size').change(function(){
        var size = parseInt($(this).val());

        $('.colspan').attr("colspan", size-1);
        if(size % 2 == 0){
            $('#has-free-space').hide().prop("disabled", true);
        } else {
            $('#has-free-space').show().prop("disabled", false);
        }

        $('#bingo-boxes th').each(function(i, el){
            if(i >= size){
                $(this).hide();
            } else {
                $(this).show();
            }

        });

       rebuildGrid(size);
    }).change();
});


