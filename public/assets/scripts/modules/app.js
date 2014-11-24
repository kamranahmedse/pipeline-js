var Shortener = {

    init : function () {
        this.bindUI();
    },

    bindUI : function () {

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
    }
}

$(document).on('ready', function () {
    Shortener.init();
});