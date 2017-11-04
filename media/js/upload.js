jQuery.event.props.push( "dataTransfer" );
$(document).ready(function(){
    var enable_drag_n_drop =  window.FormData && window.URL && window.Blob;
    if(!enable_drag_n_drop){
        return;
    }

    $('body').on("drop dragover dragend dragenter dragleave", function(e){
        e.preventDefault();
    });

    $('.card').on("drop", 'textarea.has-image', function(e){
        e.preventDefault();
        $('textarea').removeClass("over");
        // find all the textareas starting from the one we were on
        var all = $.merge([], $(this))
        $.merge(all, $(this).closest("td").nextAll().find("textarea:visible"))
        $.merge(all, $(this).closest("tr").nextAll().find("textarea:visible"))
        $.merge(all, $(this).closest("tbody").find("textarea:visible"))
        for(var i = 0; i < e.dataTransfer.files.length; i++){
            readfile(e.dataTransfer.files[i], $(all[i]));
        }
    }).on("dragover", 'textarea.has-image', function(e){
        e.preventDefault();
    }).on("dragend", 'textarea.has-image', function(e){
        e.preventDefault();
        $('textarea').removeClass("over");
    }).on("dragenter", 'textarea.has-image', function(e){
        e.preventDefault();
        $(this).addClass("over");
    }).on("dragleave", 'textarea.has-image', function(e){
        e.preventDefault();
        $(this).removeClass("over");
    }).on("keydown", 'textarea.has-image', function(e){
        if(e.altKey && (e.keyCode == 8 || e.keyCode == 46)){
            $(this).parent().find(".img").val("");
            $(this).css("background-image", "");
        }
    }).on("paste", 'textarea.has-image', function(e){
        try {
            for (var i = 0; i < e.originalEvent.clipboardData.items.length; i++) {
                var item = e.originalEvent.clipboardData.items[i];
                if (item.type.indexOf("image") != -1) {
                    readfile(item.getAsFile(), $(this));
                }
            }
        } catch (e) {
            // doesn't support clipboardData
        }
    })
});

var warned_about_upload_limit = false;

function readfile(file, element) {
    warned_about_upload_limit = false;
    if(file.type.indexOf("image/") == -1){
        return file.name + " is not an acceptable image file"
    }
    element.addClass("loading")
    element.css("background-image", "");
    //var reader = new FileReader()
    //reader.onloadend = function(e){
    var local_url = URL.createObjectURL(file);
    var img = $(new Image())
    img.attr("src", local_url);
    img.one("load", function(){
        URL.revokeObjectURL(local_url)
        var formData = new FormData();
        var blob = dataURItoBlob(resizeImage(this));
        // now post a new XHR request
        $.getJSON("/upload", {content_type: file.type, name: file.name}).success(function(data){
            url = data.url
            for(var key in data.fields){
                formData.append(key, data.fields[key])
            }
            formData.append('file', blob);
            $.ajax({
                url: url,
                data: formData,
                contentType: false,
                type: "POST",
                processData: false,
            }).success(function(){
                element.parent().find(".img").val(data.path)
                img.attr("src", data.path)
                img.one("load", function(){
                    element.css({
                        "background-image": "url('" + data.path + "')"
                    });
                    element.removeClass("loading")
                })
            }).fail(function(){
                alert("Failed to upload image");
                element.removeClass("loading")
            });
        }).fail(function(data){
            if(!warned_about_upload_limit){
                warned_about_upload_limit = true;
                alert(data.responseText);
            }
            element.removeClass("loading")
        });
    });
}
function resizeImage(img){
    /*
    Returns the image element as a dataurl resized to be at most 800x600
    */
    var MAX_WIDTH = 150.0;
    var MAX_HEIGHT = 150.0;

    var width = img.width;
    var height = img.height;
    var canvas = $('<canvas>');
    canvas.css({"display": "none"})
    $('body').append(canvas)
    var scale = Math.min(MAX_HEIGHT/height, MAX_WIDTH/width)
    if(scale < 1){
        height *= scale;
        width *= scale;
    }

    canvas.attr('width', width);
    canvas.attr('height', height);

    var raw_canvas = canvas.get(0);
    var ctx = raw_canvas.getContext("2d");
    ctx.drawImage(img, 0, 0, width, height)
    var dataurl = raw_canvas.toDataURL("image/png");
    canvas.remove()
    return dataurl
}
function dataURItoBlob(dataURI) {
    // convert base64/URLEncoded data component to raw binary data held in a string
    var byteString;
    if (dataURI.split(',')[0].indexOf('base64') >= 0)
        byteString = atob(dataURI.split(',')[1]);
    else
        byteString = unescape(dataURI.split(',')[1]);

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    // write the bytes of the string to a typed array
    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    return new Blob([ia], {type:mimeString});
}
