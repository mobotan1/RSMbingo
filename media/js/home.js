$(document).ready(function(){
    $('textarea').one("focus", function(){
        setTimeout(function(){
            $(this).select();
        }.bind(this), 1);
    });

    $('#clear-link a').click(function(){
        $('.card textarea').val("");
        $('.card input[type="hidden"]').val("");
        $('input[type=text]').val("");
        $('input[name=name]').focus()
        return false;
    });

    getCurrentSize = function(){
        return $(".card tbody tr:first td").length;
    }

    function rebuildGrid(new_size){
        // get all the text in the cells
        var cells = []; 
        var old_size = $(".card tbody tr:first td").length; // num of rows before change
        var length = $(".card tbody td").find("textarea").length; // num of cells before change
        var new_l=new_size*new_size;                        //num of cells after change
        for(var i = 0; i < Math.max(length,new_l); i++){
            cells.push({ word: "" });
        }

        var i, j, k = 0; 
        if (old_size > new_size){  //decreasing 
            var l = new_l;
            $(".card tbody td").find("textarea").each(function(ind, el){
                i = Math.floor(ind/old_size); //current row
                j = ind - (i*old_size);     //current col
                if (j < new_size && i < new_size) {        //cell in new=sized grid
                    cells[k].word = $(this).val();
                    k++;
                }
                else {                       //cell for additional table 
                    //console.log("index=" + ind + ",l=" + l + ", val=" + $(this).val());
                    if ($(this).val()) { //val is not empty
                        cells[l].word = $(this).val();
                        l++;
                    }
                }
            });
            //console.log(cells);   
            // trim empty rows. We only care about trimming rows past the normal grid size.
            //var trimmed_cells = cells.slice(0, new_size*new_size);  
        }
        else{ //increasing 
            var l = old_size;
            var p, r = 0;
            $(".card tbody td").find("textarea").each(function(ind, el){
                i = Math.floor(ind/old_size); //current row
                j = ind - (i*old_size);     //current col
                if (ind < (old_size*old_size)){          //cur cell index < old length (num of cells)
                    k=i*new_size+j;
                    cells[k].word = $(this).val();
                }
                else {
                    p = l + new_size * r; 
                    console.log(p + "," + l + "," + r + ", " + ind + "," + $(this).val());   
                    cells[p].word = $(this).val();
                    l++;
                    if (l >= new_size) { 
                        if ((r+1) < old_size) { l = old_size; } else { l = 0; }
                        r++;
                    }         
                }
                
                
            });
        }
 //console.log(cells);   
 
        // delete blank values
        for (var i = cells.length-1; i >= new_l ; i--){
            if (!cells[i].word) {
                cells.splice(i, 1);
                //console.log(i + " deleted");
            }   
        }
        //console.log(cells);   
            // we don't care about empty rows in the normal grid
        //    var is_row_empty = true;
        //    for(var c = 0; c < new_size; c++){
        //        is_row_empty &= cells[i+c] ? (cells[i+c].word == "") : true
        //    }

        //    if(!is_row_empty){
        //        for(var c = 0; c < new_size; c++){
        //            trimmed_cells.push(cells[i+c]);
        //       }
        //    }
        //}
        //console.log(trimmed_cells);
        //cells = trimmed_cells;
        
        var number_of_rows = Math.ceil((cells.length) / new_size);
        // ensure we have enough rows for the min_count
        //while(cells.length < (number_of_rows * new_size)){
        for(var i = cells.length-1; i < (number_of_rows * new_size); i++){
            cells.push({ word: "" });
        }

        // start rebuilding the table
        $(".card tbody tr").remove();
        var $tbody = $(".card tbody");


        //onsole.log(cells.length + ", " + new_size);
        var word_id = "";
        for(var r = 0, extra_row_index = -new_size*new_size, i = 0; r < number_of_rows; r++){
            // add in the "extra rows" UI row
            if(r === new_size){
                $tbody.append("<tr><td colspan='" + new_size + "' class='extra-words'>Extra Words</td></tr>");
            }
            $tr = $("<tr>");
            $tbody.append($tr);

            for(var c = 0; c < new_size; c++, i++, extra_row_index++){
                if (r < new_size) { word_id = "word-" + r + "-" + c;  }
                else{ word_id = "word-" + extra_row_index; }
                if (cells[i].word === null){ cells[i].word = ""; }
                var html = '<td><textarea name="' + word_id + '">' + cells[i].word +'</textarea></td>';
                $tr.append(html);
            }
            $tbody.append("</tr>");
        }
    }

    $('#id_size').change(function(){
        var size = parseInt($(this).val());

        $('.colspan').attr("colspan", size-2);
        if(size % 2 == 0){
            $('#has-free-space').hide().prop("disabled", true);
        } else {
            $('#has-free-space').show().prop("disabled", false);
        }

       rebuildGrid(size);
    }).change();
});


