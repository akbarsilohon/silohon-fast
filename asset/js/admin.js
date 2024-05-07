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
});

if( jQuery('#builder_active').val() === 'true' ){
    jQuery('#postdivrich, #pageparentdiv, #postimagediv, #edit-slug-box').hide();
}