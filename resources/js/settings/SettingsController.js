import toastr from 'toastr';

const SettingsController = function () {
    /**
     * Set buttons handlers.
     */
    const bindHandlerEvents = () => {
        $('#profile_picture').click(() => {
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
                var fileReader = new FileReader(),
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
                    };
                } else {
                    toastr.error("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#download").click(function() {
            $($image).cropper('getCroppedCanvas').toBlob(function (blob) {
                const formData = new FormData();

                formData.append('croppedImage', blob);

                $.ajax('/settings/change-photo', {
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
                        $('#update_photo_modal').modal('hide');
                        toastr.success("Successfully updated!");
                    },
                    error: function () {
                        toastr.error("Upload error!");
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
    };

    /**
     * Init select with Select2.
     */
    const initSelect = () => {
        $('#users-settings select').select2({width: '100%'});
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