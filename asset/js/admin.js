jQuery(document).ready( function( $ ){

    // Logo
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
});