var Shortener = {

    searchTermErrors : [
        'Hey! Where is the search term',
        'No search term! Are you serious? You want me to search ..and you don\'t know what?',
        'Watchout! you missed the search term.',
        'No search term! You forgot to enter or are you in love with that fat button over there',
        'Hey, You missed that search term!'
    ],

    init : function () {
        
        this.bindUI();

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
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

        $('.instantShorten').on('click', function () {

            var url = $('input[name=url]').val();
            $('.modal-errors').hide();

            if ( self.isValidUrl( url ) ) {
                self.instantShorten( url );
            } else {
                $('.modal-errors').show();
                $('.modal-errors .span8').html('<div class="alert alert-error modal-error">Invalid long URL provided.</div>');
            }

        });

        $('.saveBookmark').on('click', function ( e ) {
            
            e.preventDefault();

            if ( self.validateSaveBookmark() ) {
                self.saveBookmark();
            };
        });

        $('.search-bookmark').on('click', function ( e ) {

            if ( !$('input[name="term"]').val() ) {
                e.preventDefault();
                $('.js-errors').html(self.searchTermErrors[ Math.floor((Math.random() * 4)) ]);
                $('.js-errors').show();
            };
        });

        $(document).on('click', '.edit-bookmark', function ( e ) {
            
            e.preventDefault();

            var bookmarkId = $(this).data('id');
            self.populateBookmarkDetail( bookmarkId );
        });

        $('#new-event-modal').on('hidden', function () {

            $(this).find('.modal-bmark-save').text('Store a new Bookmark!');

            $(this).find('input[name="url_title"]').val('');
            $(this).find('input[name="url"]').val('');
            $(this).find('input[name="shortened_url"]').val('');
            $(this).find('.saveBookmark').data('id', '')
                                         .text('Create');
        });
    },

    validateSaveBookmark : function () {

        var errContainer = $('.modal-errors .span8'),
            noError = true,
            errWrap = $('.modal-errors');        

        errWrap.hide();
        errContainer.empty();

        if ( !$('input[name=url_title]').val() ) {
            
            errWrap.show();
            
            errContainer.append('<div class="alert alert-error modal-error">Title for the URL must be provided.</div>');
            noError = false;
        };

        if ( !$('input[name=url]').val() ) {
            
            errWrap.show();

            errContainer.append('<div class="alert alert-error modal-error">Long URL must be provided.</div>');
            noError = false;

        } else if ( !this.isValidUrl( $('input[name=url]').val() ) ) {
            errWrap.show();

            errContainer.append('<div class="alert alert-error modal-error">Invalid long URL provided.</div>');
            noError = false;
        }

        return noError;
    },

    populateBookmarkDetail : function ( bookmarkId ) {
        $.ajax({
            url : fetchBookmarkUrl,
            data : { id : bookmarkId },
            method : 'post',
            dataType : 'json',
            beforeSend : function () {},
            success : function ( data ) {
                if ( data ) {
                    
                    $('#new-event-modal .modal-bmark-save').text('Update Bookmark!');

                    $('#new-event-modal input[name="url_title"]').val(data.description);
                    $('#new-event-modal input[name="url"]').val(data.url);

                    $('#new-event-modal .saveBookmark').data('id', data.id)
                                                       .text('Update');

                    if ( data.shortened_code ) {
                        $('#new-event-modal input[name="shortened_url"]').val(shortDomain + data.shortened_code);
                    };

                    $('#new-event-modal').modal();

                } else {
                    $.toast({
                       text : "Bookmark not found!",
                       hideAfter : false,
                       bgColor : '#0FB190'
                    });
                }
            },
            complete : function () {}
        });
    },

    instantShorten : function ( url ) {

        if ( !window.shortenBookmarkUrl ) {
            alert('Problem occured! Please reload your window and try again.');
        };

        $.ajax({
            url : shortenBookmarkUrl,
            dataType : 'json',
            data : { long_url : url, do_save : false },
            method : 'post',
            beforeSend : function () {},
            success : function ( data ) {
                if (data.short_url) {
                    $('input[name=shortened_url]').val( data.short_url );
                } else {
                    $('.modal-errors').show();
                    $('.modal-errors .span8').html('<div class="alert alert-error modal-error">Problem occured! Please verify if the input was in valid form.</div>');
                }
            },
            complete : function () {}
        });

    },

    isValidUrl : function ( url ) {
        return url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
    },

    saveBookmark : function () {

        var shortCode = $('input[name=shortened_url]').val(),
            parts = shortCode.split('/');

        shortCode = parts[ parts.length-1 ];

        $.ajax({
            url : saveBookmarkUrl,
            dataType : 'json',
            data : { title : $('input[name=url_title]').val(), long_url : $('input[name=url]').val(), shortened_code : shortCode, id : $('.saveBookmark').data('id') },
            method : 'post',
            beforeSend : function () {},
            success : function ( data ) {
                if (data.success) {

                    $('.modal').modal('hide');
                    
                    $.toast({
                        text : data.success,
                        hideAfter : 2000,
                        allowToastClose : false,
                        textAlign : 'center',
                        bgColor : '#0FB190',
                        position : 'mid-center',
                        afterHidden : function () {
                            window.location.reload();
                        }
                    });

                } else {
                    $('.modal-errors').show();
                    $('.modal-errors .span8').html('<div class="alert alert-error modal-error">' + data.error + '</div>');
                }
            },
            complete : function () {}
        });
    }
}

$(document).on('ready', function () {
    Shortener.init();
});