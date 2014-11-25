var Shortener = {

    init : function () {
        this.bindUI();
    },

    bindUI : function () {

        var self = this;

        $(document).on('click', '.removeUrl', function ( e ) {

            e.preventDefault();

            var deleteBtn = $('.modal-delete-url'),
                href = deleteBtn.attr('href'),
                toDeleteId = $(this).data('id');

            href = href.replace(/\?.*/, '') + '?id=' + toDeleteId;
            
            deleteBtn.data('id', toDeleteId)
                     .attr('href', href);
        });

        $(document).on('click', '.modal-delete-url', function ( e ) {

            var url_id = $(this).data('id');

            if ( !url_id || url_id == 0 ) {
                e.preventDefault();
            };
        });

        $('.remove-modal').on('hide', function () {
            $(this).find('.modal-delete-url').data('id', 0);
        });

        $('.saveBookmark').on('click', function ( e ) {
            
            e.preventDefault();

            if ( self.validateSaveBookmark() ) {
                self.saveBookmark();
            };
        });
    },

    validateSaveBookmark : function () {

        var noError = true;

        if ( $('input[name=url_title]').val() ) {
            $('.modal-errors .span8').html('<div class="alert alert-error modal-error">Title for the URL must be provided.</div>');
            noError = false;
        };

        if ( $('input[name=url]').val() ) {

        };

        return noError;
    },

    saveBookmark : function () {

    }
}

$(document).on('ready', function () {
    Shortener.init();
});