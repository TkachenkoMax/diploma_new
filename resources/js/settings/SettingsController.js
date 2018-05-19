import toastr from 'toastr';
import * as Ladda from 'ladda';

const SettingsController = function () {

    /**
     * Delete photo.
     */
    this.deletePhoto = function () {
        window.swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            type: 'warning',
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!'
        }, function () {
            $.ajax({
                url: `/settings/delete-photo`,
                type: 'GET',
                success: response => {
                    const newUrl = response.link;
                    $('#profile_picture').attr('src', newUrl);
                    toastr.success('Photo successfully deleted!');
                },
                error: data => {
                    toastr.error('Something went wrong!', data.responseJSON.error);
                }
            });
        });
    };

    /**
     * Set buttons handlers.
     */
    const bindHandlerEvents = () => {
        $('#profile_picture').mouseover(() => {
           $('.img-wrap .overlay').css('opacity', 1);
        }).mouseleave((e) => {
            if ($(e.relatedTarget).hasClass('overlay'))
            {
                $(e.relatedTarget).mouseleave(() => {
                    $('.img-wrap .overlay').css('opacity', 0);
                });

                return;
            }

            $('.img-wrap .overlay').css('opacity', 0);
        }).click(() => {
            $('#update_photo_modal').modal('show');
        });

        //Image editor initialization.
        const $image = $(".image-crop > img");
        $($image).cropper({
            aspectRatio: 1,
            preview: ".img-preview",
            done: function(data) {
                // Output the result data for cropping image.
            }
        });

        const $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function() {
                let fileReader = new FileReader(),
                    files = this.files,
                    file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                        $("#zoomIn, #zoomOut, #rotateLeft, #rotateRight, #download").prop('disabled', false);
                    };
                } else {
                    toastr.error("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        const laddaDownload = Ladda.create(document.querySelector('#download'));

        $("#download").click(function() {
            $($image).cropper('getCroppedCanvas').toBlob(function (blob) {
                laddaDownload.start();
                const formData = new FormData();

                formData.append('croppedImage', blob);

                $.ajax('/settings/change-photo', {
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: response => {
                        const newUrl = response.link;
                        $('#profile_picture').attr('src', newUrl);
                        $('#update_photo_modal').modal('hide');
                        toastr.success("Successfully updated!");
                    },
                    error: () => {
                        toastr.error("Upload error!");
                    },
                    complete: () => {
                        laddaDownload.stop();
                    }
                });
            });
        });

        $("#zoomIn").click(function() {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function() {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function() {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function() {
            $image.cropper("rotate", -45);
        });

        $(document).on('click', '#user-settings #delete_photo', this.deletePhoto);
    };

    /**
     * Init select with Select2.
     */
    const initSelect = () => {
        $('#user-settings select').select2({width: '100%'});
    };


    /**
     * Initialize function.
     *
     * @return void
     */
    this.init = () => {
        initSelect();
        bindHandlerEvents();
    };
};

$(document).ready(function () {
    window.settingsController = new SettingsController();
    window.settingsController.init();
});