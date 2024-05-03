<?php
/**
 * Handler save main settings
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_settings_section( 'main-top', '<span class="fast-admin-section">Custom Logo</span>', null, 'fast-dash' );
register_setting( 'fast-settings-group', 'fast_main' );

// Logo
add_settings_field( 'logo', 'Logo Blog', function(){
    $option = get_option('fast_main')['logo']; ?>

    <input type="url" name="fast_main[logo]" id="counterLogo" value="<?php echo esc_url( $option ) ?>" /><br>
    <button style="margin-top: 10px" id="changeLogo" type="button" class="button button-primary">
        <?php
            $text = !empty( $option ) ? 'Change' : 'Upload';
            echo $text;
        ?>
    </button>

    <?php
}, 'fast-dash', 'main-top' );