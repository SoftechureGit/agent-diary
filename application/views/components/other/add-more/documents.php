
<?php if(count($records)): ?>
    <?php 
        foreach($records ?? [] as $record_key => $record): 
            $record_key     = ++$record_key;
        ?>
            <!-- Static Card -->
            <div class="card p-4 record-data clone-template <?= ($record_key == 1) ? 'parent-clone-template' : '' ?>" data-parent-type="documents" data-clone-template-id="<?= $record_key; ?>">
                <?php if($record_key == 1): ?>
                    <span class="reset-clone-template-row fa fa-refresh bg-warning" onclick="resetCloneTemplateRow(this)"></span>
                    <span class="remove-clone-template-row fa fa-trash" data-id=<?= $record->id ?> data-type="documents" onclick="removeCloneTemplateRowDB(this)"></span>
                    <?php else: ?>
                        <span class="remove-clone-template-row fa fa-trash" data-id=<?= $record->id ?> data-type="documents" onclick="removeCloneTemplateRowDB(this)"></span>
                <?php endif; ?>

                <div class="row item-row w-100">
                    <!-- Title -->
                    <div class="col">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control document-title" placeholder="Enter title" name="documents[<?= $record_key; ?>][title]" value="<?= $record->title; ?>">
                        </div>
                    </div>
                    <!-- End Title -->

                    <!-- File -->
                    <div class="col">
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control file p-2 mb-1" placeholder="Enter file" name="documents[<?= $record_key; ?>][file]">
                            <div class="saved-file-name" title="<?= $record->file_name ?? '' ?>"><?= $record->file_name; ?></div>
                            <input type="hidden" class="old-file" name="documents[<?= $record_key; ?>][old_file]" value="<?= $record->file_name; ?>">
                            <?php if($record->file_url): ?>
                                <a href="<?= $record->file_url ?>" target="_blank" class="text-info view-file" title="<?= $record->file_name ?? '' ?>">View</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- End File -->
                </div>
            </div>
            <!-- End Static Card -->
    <?php endforeach; ?>

<?php else: ?>
    <!-- Static Card -->
    <div class="card p-4 record-data clone-template" data-clone-template-id="1">
        <div class="row item-row w-100">
             <!-- Title -->
             <div class="col">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control document-title" placeholder="Enter title" name="documents[1][title]">
                </div>
            </div>
            <!-- End Title -->

            <!-- File -->
            <div class="col">
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" class="form-control file p-2" placeholder="Enter file" name="documents[1][file]">
                </div>
            </div>
            <!-- End File -->
        </div>
    </div>
    <!-- End Static Card -->
     <?php endif; ?>
