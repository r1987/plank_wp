<?php
/*
**  - - - - - - - - - - - - - - - - - - - - - -
**  LAZYSIZES IMAGES
**  usage: <?php echo lazy_pictures(get_post_thumbnail_id()); ?>
**  - - - - - - - - - - - - - - - - - - - - - -
*/
function lazy_pictures( $image ) {
    //$img_low = wp_get_attachment_image_src($image, 'image-low');
    $img_high = wp_get_attachment_image_src($image, 'image-high');
    $img_small = wp_get_attachment_image_src($image, 'image-small');
    $img_medium = wp_get_attachment_image_src($image, 'image-medium');

    // Small
    $small_filename = $img_small[0];
    $small_extension_pos = strrpos($small_filename, '.');
    $project_image_small_retina = substr($small_filename, 0, $small_extension_pos) . '@2x' . substr($small_filename, $small_extension_pos);

    // Medium
    $medium_filename = $img_medium[0];
    $medium_extension_pos = strrpos($medium_filename, '.');
    $project_image_medium_retina = substr($medium_filename, 0, $medium_extension_pos) . '@2x' . substr($medium_filename, $medium_extension_pos);

    // Fallback
    $fallback_filename = $img_high[0];
    $fallback_extension_pos = strrpos($fallback_filename, '.');
    $project_image_fallback_retina = substr($fallback_filename, 0, $fallback_extension_pos) . '@2x' . substr($fallback_filename, $fallback_extension_pos);

    // echo '<li>"' .$small_filename. '"';
    // echo '<li>"' .$medium_filename. '"';
    // echo '<li>"' .$fallback_filename. '"';
    // echo '<li>"' .$project_image_small_retina. '"';
    // echo '<li>"' .$project_image_medium_retina. '"';
    // echo '<li>"' .$project_image_fallback_retina. '"';

    // Intrinsic CSS Images (Aspect Ratio * 100)
    $aspect_ratio = $img_high[2] / $img_high[1] * 100;

    $srcset = '<div class="ratio-box" style="padding-top:' . $aspect_ratio . '%">';
    $srcset .= '<picture>';
    $srcset .= '<!--[if IE 9]><video style="display: none;><![endif]-->';
    $srcset .= '<source data-srcset="' . $small_filename . ' 1x, ' . $project_image_small_retina . ' 2x" media="(max-width: 480px)" />';
    $srcset .= '<source data-srcset="' . $medium_filename . ' 1x, ' . $project_image_medium_retina . ' 2x" media="(max-width: 1024px)" />';
    $srcset .= '<source data-srcset="' . $fallback_filename . ' 1x, ' . $project_image_fallback_retina . ' 2x" media="(max-width: 1400px)" />';
    $srcset .= '<source data-srcset="' . $fallback_filename . ' 1x, ' . $project_image_fallback_retina . ' 2x" />';
    $srcset .= '<!--[if IE 9]></video><![endif]-->';
    $srcset .= '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $fallback_filename . ' 1x, ' . $project_image_fallback_retina . ' 2x" class="lazyload" alt="image with artdirection" />';
    $srcset .= '</picture>';
    $srcset .= '</div>';

    return $srcset;
}
?>
