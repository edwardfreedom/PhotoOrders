


$(function () {

    var ul = $('#progress_load');

    $('#drop a').click(function () {
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        done: function (e, data) {

            var json = JSON.parse(data.result);

            $('#imagesArray').append(Item.itemRender("uploads/" + json.filePath));
            changeMoney.reCount();

        },


        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {


            NProgress.start();
            var jqXHR = data.submit();
        },

        progress: function (e, data) {

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);


            NProgress.set(progress);

        },

        fail: function (e, data) {
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});
