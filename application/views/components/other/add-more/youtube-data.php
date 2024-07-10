<?php

if (count((array)$youtube_data)) :
    foreach ($youtube_data as $youtube_data_key => $item) :
        $youtube_data_key = ++$youtube_data_key;
?>
        <!-- Static Youtube Data Card -->
        <div class="card p-4 youtube-data clone-template" data-clone-template-id="<?= $youtube_data_key; ?>">
            <?php if($youtube_data_key != 1):?>
                <span class="remove-clone-template-row fa fa-trash" onclick="removeCloneTemplateRow(this)" <?= $youtube_data_key; ?>></span>
            <?php endif; ?>

            <div class="row item-row w-100">
                <!-- Title -->
                <div class="col">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control youtube-title" placeholder="Enter title" value="<?= $item->title ?? '' ?>" name="youtube_data[<?= $youtube_data_key; ?>][title]" value="">
                    </div>
                </div>
                <!-- End Title -->

                <!-- Youtube Link -->
                <div class="col">
                    <div class="form-group">
                        <label for="link">Youtube Link</label>
                        <input type="text" class="form-control link mb-2" placeholder="Enter link" name="youtube_data[<?= $youtube_data_key; ?>][link]" value="<?= $item->link ?? '' ?>">
                    </div>
                </div>
                <!-- End Youtube Link -->
            </div>
        </div>
        <!-- End Static Youtube Data Card -->
    <?php
    endforeach;
else :
    ?>
    <!-- Static Youtube Data Card -->
    <div class="card p-4 youtube-data clone-template" data-clone-template-id="1">
        <div class="row item-row w-100">
            <!-- Title -->
            <div class="col">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control youtube-title" placeholder="Enter title" name="youtube_data[1][title]" value="">
                </div>
            </div>
            <!-- End Title -->

            <!-- Youtube Link -->
            <div class="col">
                <div class="form-group">
                    <label for="document_file">Youtube Link</label>
                    <input type="text" class="form-control link" placeholder="Enter link" name="youtube_data[1][link]">
                </div>
            </div>
            <!-- End Youtube Link -->
        </div>
    </div>
    <!-- End Static Youtube Data Card -->
<?php
endif;
?>