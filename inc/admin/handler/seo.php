<?php
/**
 * Handler SEO Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_settings_section( 'seo1', null, null, 'fast-seo' );
register_setting( 'fast-settings-seo', 'seo_one' );

/**
 * Redirect to homepage
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-redirect', 'Redirect 404 to Homepage', function(){
    $redirect = get_option('seo_one'); ?>

    <input type="checkbox" name="seo_one[redirect]" value="true" <?php if(!empty($redirect['redirect']) && $redirect['redirect'] === 'true') echo 'checked';  ?>>

    <?php
}, 'fast-seo', 'seo1' );


/**
 * New section for data schema organization
 * 
 * @package silohon-fast
 */
add_settings_section( 'seo2', '<h2 class="fast-admin-section">Organization</h2>', null, 'fast-seo' );
register_setting( 'fast-settings-seo', 'seo_two' );


/**
 * Organizatio schema active or not
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization', 'Schema Active?', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="checkbox" name="seo_two[organization]" value="true" <?php if(!empty($organization['organization']) && $organization['organization'] === 'true') echo 'checked';  ?>>

    <?php
}, 'fast-seo', 'seo2' );



/**
 * Organization Name
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-name', 'Organization Name', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[name]" value="<?php echo $organization['name']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization url
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-url', 'URL', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="url" name="seo_two[url]" value="<?php echo $organization['url']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization sameAs
 * 
 * Thi can use multi using bottom add and delete input
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-sameas', 'sameAs', function(){
    $organization = get_option('seo_two');
    $sameAs = $organization['sameAs'];
    ?>

    <ul class="multiInput" id="multiInput">
        <?php if(!empty($sameAs)){
            foreach( $sameAs as $same){ ?>
                <li class="listInput">
                    <input type="url" name="seo_two[sameAs][]" value="<?php echo esc_attr( $same ); ?>" />
                    <button type="button" class="remove-sameas">
                        <span class="dashicons dashicons-trash"></span>
                    </button>
                </li>
                <?php
            }
        } ?>
    </ul>

    <button class="button button-primary" type="button" id="add-sameas">
        Add URL
    </button>

    <script>
        jQuery(document).ready(function ($) {
            $('#add-sameas').on('click', function () {
                $('#multiInput').append(`
                    <li class="listInput">
                        <input type="url" name="seo_two[sameAs][]">
                        <button type="button" class="remove-sameas"><span class="dashicons dashicons-trash"></span></button>
                    </li>
                `);
            });

            $('#multiInput').on('click', '.remove-sameas', function () {
                $(this).closest('.listInput').remove();
            });
        });
    </script>

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization logo
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-logo', 'Logo', function(){
    $organization = get_option('seo_two');
    $buttonText = !empty($organization['logo']) ? 'Change Logo' : 'Set Logo';
    ?>

    <input type="url" name="seo_two[logo]" id="ogLogo" value="<?php echo $organization['logo']; ?>"><br>
    <button style="margin-top: 10px" id="ogLogoChange" type="button" class="button button-primary"><?php echo $buttonText; ?></button>

    <?php
}, 'fast-seo', 'seo2' );



/**
 * Organization image
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-image', 'Image', function(){
    $organization = get_option('seo_two');
    $buttonText = !empty($organization['image']) ? 'Change Image' : 'Set Image';
    ?>

    <input type="url" name="seo_two[image]" id="ogImg" value="<?php echo $organization['image']; ?>"><br>
    <button style="margin-top: 10px" id="ogImgChange" type="button" class="button button-primary"><?php echo $buttonText; ?></button>

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization description
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-description', 'Description', function(){
    $organization = get_option('seo_two');

    ?>

    <textarea name="seo_two[description]" rows="4"><?php echo $organization['description']; ?></textarea>

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization email
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-email', 'Email', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="email" name="seo_two[email]" value="<?php echo $organization['email']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization telephone
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-telephone', 'Telephone', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="tel" name="seo_two[telephone]" value="<?php echo $organization['telephone']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization streetAddress
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-streetaddress', 'Street Address', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[streetAddress]" value="<?php echo $organization['streetAddress']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization addressLocality
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-addresslocality', 'Address Locality', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[addressLocality]" value="<?php echo $organization['addressLocality']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization addressCountry
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-addresscountry', 'Address Country', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[addressCountry]" value="<?php echo $organization['addressCountry']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization addressRegion
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-addressregion', 'Address Region', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[addressRegion]" value="<?php echo $organization['addressRegion']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization postalCode
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-postalcode', 'Postal Code', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[postalCode]" value="<?php echo $organization['postalCode']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization vatID
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-vatid', 'Vat ID', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[vatID]" value="<?php echo $organization['vatID']; ?>">

    <?php
}, 'fast-seo', 'seo2' );


/**
 * Organization iso6523Code
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-organization-iso6523code', 'Iso6523 Code', function(){
    $organization = get_option('seo_two');

    ?>

    <input type="text" name="seo_two[iso6523Code]" value="<?php echo $organization['iso6523Code']; ?>">

    <?php
}, 'fast-seo', 'seo2' );