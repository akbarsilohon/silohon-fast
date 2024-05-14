<?php
/**
 * Cache Panel Controll
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_settings_section( 'cache-section', null, null, 'fast-ca' );
register_setting( 'fast-settings-cache', 'fast_option_cache' );


/**
 * Active or not
 * 
 * @package silohon-fast
 */
add_settings_field(
    'ca-active', 
    'Use Cache', 
    function(){
        $options = get_option('fast_option_cache');
        $isActive = isset($options['active']) && $options['active'] === 'true' ? 'checked' : '';
        ?>

        <input type="checkbox" name="fast_option_cache[active]" value="true" <?php echo $isActive; ?>>

<?php
    }, 
    'fast-ca', 
    'cache-section'
);


/**
 * Cache Expired
 * 
 * @package silohon-fast
 */
add_settings_field( 
    'cache-time', 
    'Cache Expired', 
    function(){
        $options = get_option('fast_option_cache'); ?>

        <select name="fast_option_cache[time]">
            <option value="">Select Duration</option>
            <option value="3600" <?php selected( $options['time'], '3600' ); ?>>1 Hour</option>
            <option value="86400" <?php selected( $options['time'], '86400' ); ?>>24 Hours</option>
            <option value="604800" <?php selected( $options['time'], '604800' ); ?>>7 Days</option>
            <option value="2592000" <?php selected( $options['time'], '2592000' ); ?>>1 Month</option>
            <option value="15552000" <?php selected( $options['time'], '15552000' ); ?>>6 Months</option>
            <option value="31536000" <?php selected( $options['time'], '31536000' ); ?>>1 Year</option>
        </select>

        <?php
    }, 
    'fast-ca', 
    'cache-section'
);