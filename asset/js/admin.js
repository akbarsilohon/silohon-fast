jQuery(document).ready( function( $ ){

    // Logo =====================
    var fastLogo;
    $('#changeLogo').on('click', function(e){
        e.preventDefault();

        if( fastLogo ){
            fastLogo.open();
            return;
        }

        fastLogo = wp.media.file_frame = wp.media({
            title: 'Choose a Logo',
            button: {
                text: 'Choose'
            },
            multiple: false
        });

        fastLogo.on('select', function(){
            attachment = fastLogo.state().get('selection').first().toJSON();
            $('#counterLogo').val( attachment.url );
        });

        fastLogo.open();
    });


    /**
     * Organization Logo =====================
     */
    var orgLogo;
    $('#ogLogoChange').on('click', function(e){
        e.preventDefault();

        if( orgLogo ){
            orgLogo.open();
            return;
        }

        orgLogo = wp.media.file_frame = wp.media({
            title: 'Choose a Logo',
            button: {
                text: 'Choose'
            },
            multiple: false
        });

        orgLogo.on('select', function(){
            attachment = orgLogo.state().get('selection').first().toJSON();
            $('#ogLogo').val( attachment.url );
        });

        orgLogo.open();
    });


    /**
     * Organization Image =====================
     */
    var ogImg;
    $('#ogImgChange').on('click', function(e){
        e.preventDefault();

        if( ogImg ){
            ogImg.open();
            return;
        }

        ogImg = wp.media.file_frame = wp.media({
            title: 'Choose a Logo',
            button: {
                text: 'Choose'
            },
            multiple: false
        });

        ogImg.on('select', function(){
            attachment = ogImg.state().get('selection').first().toJSON();
            $('#ogImg').val( attachment.url );
        });

        ogImg.open();
    });


    /**
     * Page Builder button
     * 
     * @package silohon-fast
     */
    $('#fast_call_builder').click( function(){
        if($(this).hasClass('button-primary builder-active')){
            $(this).removeClass('button-primary builder-active');
            $('#postdivrich, #pageparentdiv, #postimagediv, #edit-slug-box').fadeIn();
            $('#builder_active').val('');
            $('#fastHomeBuilder').hide();
            $(this).text('Use Builder');
        } else{
            $(this).addClass('button-primary builder-active');
            $('#builder_active').val('true');
            $('#fastHomeBuilder').fadeIn();
            $('#postdivrich, #pageparentdiv, #postimagediv, #edit-slug-box').hide();
            $(this).text('Remove Builder');
        }

        return false;
    });


    // Close items ====================
    // ================================
    $('#closehero').click(function(){
        $('#closehero').hide();
        $('#openhero').fadeIn();
        $('.hero_body').slideUp('slow');
    });

    $('#openhero').click(function(){
        $('#openhero').hide();
        $('#closehero').fadeIn();
        $('.hero_body').slideDown('slow');
    });


    // Create item data
    $('#item_list').sortable();
    $(document).on('click', '#openDATAs', function(){
        $(this).closest('.data_item').find('.body_item').slideDown('slow');
        $(this).closest('.data_item').find('#removed_list').hide();
    });
    $(document).on('click', '#closeDATAs', function(){
        $(this).closest('.data_item').find('.body_item').slideUp('slow');
        $(this).closest('.data_item').find('#removed_list').hide();
    });
});

if( jQuery('#builder_active').val() === 'true' ){
    jQuery('#postdivrich, #pageparentdiv, #postimagediv, #edit-slug-box').hide();
}

var defCat = jQuery('#cats_default').html();
jQuery('.add_data').click( function(){
    var style = jQuery(this).data('style');

    jQuery('#item_list').append('\
        <li id="data_item_'+ nextCell +'" class="data_item">\
            <div class="data_head">\
                <span class="heading">Style: '+style+'</span>\
                <div id="btnDatas">\
                    <i id="openDATAs" class="bx bx-plus-circle"></i>\
                    <i id="closeDATAs" class="bx bx-minus-circle"></i>\
                </div>\
            </div>\
            <div class="body_item">\
                <label for="">Category:</label>\
                <select name="sls_builder_data['+ nextCell +'][cat]" id="">\
                    '+defCat+'\
                </select>\
            </div>\
            <div class="body_item">\
                <label for="">Post Count:</label>\
                <input type="number" name="sls_builder_data['+ nextCell +'][count]" value="5">\
            </div>\
            <div class="body_item">\
                <label for="">Random Post:</label>\
                <input type="checkbox" name="sls_builder_data['+ nextCell +'][rand]" value="rand">\
            </div>\
            <input type="hidden" name="sls_builder_data['+ nextCell +'][style]" value="'+style+'">\
            <i id="removed_list" class="bx bx-trash"></i>\
        </li>\
    ');

    nextCell++;
});


// Delete list
jQuery(document).on('click', '#removed_list', function(){
    jQuery(this).parent().addClass('removered').fadeOut( function(){
        jQuery(this).remove();
    });
});