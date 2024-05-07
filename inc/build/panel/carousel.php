<?php
/**
 * Haldler carousel option panel
 * 
 * @package silohon-fast
 */

if(isset($get_meta['carousel'][0])){
    $carousel = false;
    if(!empty($get_meta['carousel'][0])){
        $carousel = $get_meta['carousel'][0];
        if(is_serialized($carousel)){
            $carousel = unserialize($carousel);
        }
    }
} ?>

<section class="hero">
    <div class="hero_inner">
        <span class="heading">Slider</span>
        <div id="btnhero">
            <i id="openhero" class='bx bx-plus-circle'></i>
            <i id="closehero" class='bx bx-minus-circle'></i>
        </div>
    </div>
    <div class="hero_body">

        <select style="display:none" id="cats_default">
            <?php foreach ($categories as $key => $option) : ?>
                <option value="<?php echo $key ?>"><?php echo $option; ?></option>
            <?php endforeach; ?>
        </select>

        <div class="input_type">
            <label for="">Active</label>
            <input <?php echo (isset($carousel['active']) && $carousel['active'] == 'true') ? 'checked' : ''; ?> type="checkbox" name="carousel[active]" value="true">
        </div>

        <div class="input_type">
            <label for="carousel_cat">Category:</label>
            <select name="carousel[cat]" id="carousel_cat">
                <option value="">Recent Posts</option>
                <?php foreach ($categories as $key => $option) : ?>
                    <option value="<?php echo $key ?>" <?php if (isset($carousel['cat']) && $carousel['cat'] == $key) echo 'selected'; ?>><?php echo $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input_type">
            <label for="carousel_num">Posts Per Page:</label>
            <input type="number" name="carousel[num]" id="carousel_num" value="<?php echo !empty($carousel['num']) ? $carousel['num'] : 5; ?>">
        </div>

        <div class="input_type">
            <label for="">Random Post</label>
            <input <?php echo (isset($carousel['order']) && $carousel['order'] == 'true') ? 'checked' : ''; ?> id="hero_rand" type="checkbox" name="carousel[order]" value="true">
        </div>
    </div>
</section>