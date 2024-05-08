<section class="sls_data">
    <div class="data_title">
        <div class="data_head">
            <span class="heading">Custom Style</span>
            <div id="btnData">
                <i id="openDATA" class='bx bx-plus-circle'></i>
                <i id="closeDATA" class='bx bx-minus-circle'></i>
            </div>
        </div>
        <div class="data_build">
            <a class="add_data" data-style="s1">
                <img src="<?php echo FAST_URI . '/inc/build/img/s1.png'; ?>">
            </a>
            <a class="add_data" data-style="s2">
                <img src="<?php echo FAST_URI . '/inc/build/img/s2.png'; ?>">
            </a>
            <a class="add_data" data-style="s3">
                <img src="<?php echo FAST_URI . '/inc/build/img/s3.png'; ?>">
            </a>
        </div>
    </div>

    <select style="display:none" id="cats_default">
        <?php foreach ($categories as $key => $option) { ?>
        <option value="<?php echo $key ?>"><?php echo $option; ?></option>
        <?php } ?>
    </select>

    <ul id="item_list" class="item_list">
        <?php 
            $i = 0;
            if(!empty($data) && is_array($data)){
                foreach( $data as $dt ){
                    $i++; ?>

                    <li id="data_item_<?php echo $i; ?>" class="data_item">
                        <div class="data_head">
                            <span class="heading">Style: <?php echo $dt['style']; ?></span>
                            <div id="btnDatas">
                                <i id="openDATAs" class='bx bx-plus-circle'></i>
                                <i id="closeDATAs" class='bx bx-minus-circle'></i>
                            </div>
                        </div>

                        <div class="body_item">
                            <label for="">Category:</label>
                            <select name="sls_builder_data[<?php echo $i; ?>][cat]" id="">
                                <?php  
                                    foreach($categories as $key => $option){ ?>

                                        <option value="<?php echo $key ?>" <?php if( $dt['cat'] == $key ) echo 'selected'; ?>><?php echo $option ?></option>

                                        <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="body_item">
                            <label for="">Post Count:</label>
                            <input type="number" name="sls_builder_data[<?php echo $i; ?>][count]" value="<?php echo $dt['count'] ?>">
                        </div>

                        <div class="body_item">
                            <label for="">Random Post:</label>
                            <input <?php if( isset($dt['order']) && $dt['order'] == 'rand' ) echo 'checked'; ?> type="checkbox" name="sls_builder_data[<?php echo $i; ?>][order]" value="rand">
                        </div>

                        <input type="hidden" name="sls_builder_data[<?php echo $i; ?>][style]" value="<?php echo $dt['style']; ?>">

                        <i id="removed_list" class='bx bx-trash'></i>
                    </li>

                    <?php
                }
            }
        ?>
    </ul>

    <script>
        var nextCell = <?php echo $i + 1; ?>;
        var tempPath =' <?php echo FAST_URI; ?>';
    </script>
</section>