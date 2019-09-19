Dropzone.options.dropImages = {
        dictDefaultMessage: 'Agregar archivos arrastrandolos aquí...',
        maxFilesize: 3,
        dictFileTooBig: 'Las imagenes no pueden pesar mas de 3MB',
        acceptedFiles: '.jpg, .jpeg, .png',
        previewsContainer: '#dropImages',
        previewTemplate: document.querySelector('#preview-template').innerHTML,
        addRemoveLinks: true,
        dictRemoveFile: 'Eliminar',
        dictRemoveFileConfirmation: "Seguro que queres eliminar la imagen?",

        init: function() {
            var dropImages = this,
                form_token = $('input[name=_token]').val(),
                typeOf = $('input[name=typeOf]').val(),
                posturl = '/admin/images/' +  $('input[name=objectId]').val();

            dropImages.cleaningUp = false;

            dropImages.cleanUp = function(file) {
                dropImages.cleaningUp = true;
                dropImages.removeFile(file);
                dropImages.cleaningUp = false;
            };

            dropImages.on("success", function(file, data) {
                this.cleanUp(file);
                var image = {name: data.image.original, servername: data.image.server, size: data.image.size};
                dropImages.options.addedfile.call(dropImages, image);
                dropImages.options.thumbnail.call(dropImages, image, '/photos/' + data.image.server);
                dropImages.emit("complete", image);
            });

            $.ajax({ // getting all images for this typeOf object
                type: 'GET',
                url: posturl + '/all',
                data: {typeOf: typeOf,_token: form_token},
                dataType: 'json',
                success: function (data) {
                    $.each(data.images, function (key, value) {
                        var image = {name: value.original, servername: value.server, size: value.size};
                        dropImages.options.addedfile.call(dropImages, image);
                        dropImages.options.thumbnail.call(dropImages, image, '/photos/' + value.server);
                        dropImages.emit("complete", image);
                    });
                }
            });

            $("#dropImages").sortable({
                items:'.dz-preview',
                cursor: 'move',
                opacity: 0.5,
                containment: "parent",
                distance: 20,
                tolerance: 'pointer',
                stop: function(){
                    $.map($(this).find('.dz-image img'), function(el, index) {

                        var img = $(el).attr('src'),
                            img_order = index + 1;

                        $.ajax({
                            type: 'GET',
                            url: posturl + '/update',
                            data: {imageUrl: img, order: img_order,_token: form_token},
                            dataType: 'html',
                            success: function () {
                            }
                        });
                    });
                }
            });

            dropImages.on("removedfile", function(file) {
                if (!this.cleaningUp) {
                    $.ajax({
                        type: 'GET',
                        url: posturl + '/delete',
                        data: {imageUrl: file.servername, _token: form_token},
                        dataType: 'html',
                        success: function () {
                        }
                    });
                }
            });
        },
        error: function(file, response) {
            if($.type(response) === "string")
                var message = response; //dropzone sends it's own error messages in string
            else
                var message = response.message;
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        },
    }