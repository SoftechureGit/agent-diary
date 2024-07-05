<?php
if(count($property_documents)):
    foreach($property_documents as $property_document_key => $property_document):
        $property_document_key = ++$property_document_key;
?>
<!-- Static Property Documents Card -->
<div class="card p-4 property-documents clone-template" data-clone-template-id="<?= $property_document_key; ?>">
        <?php if($property_document_key != 1 ):?>
        <span class="remove-clone-template-row fa fa-trash" onclick="removeCloneTemplateRow(this)" data-id="<?= $property_document->id ?? '' ?>"></span>
        <?php endif;?>
        <div class="row item-row w-100">
            <!-- Title -->
            <div class="col">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control document_title" placeholder="Enter document title" value="<?= $property_document->title ?? '' ?>" name="property_documents[<?= $property_document_key; ?>][title]" value="" required>
                </div>
            </div>
            <!-- End Title -->

            <!-- Document File -->
            <div class="col">
                <div class="form-group">
                    <label for="document_file">Document File</label>
                    <input type="file" class="form-control document_file mb-2" name="property_documents[<?= $property_document_key; ?>][document_file]">
                    <a href="<?= $property_document->document_full_url ?? '' ?>" class="text-primary view-property-document" target="_blank">View</a>
                </div>
            </div>
            <!-- End Document File -->
        </div>
    </div>
    <!-- End Static Property Documents Card -->
<?php
    endforeach;
else:
?>
    <!-- Static Property Documents Card -->
    <div class="card p-4 property-documents clone-template" data-clone-template-id="1">
        <div class="row item-row w-100">
            <!-- Title -->
            <div class="col">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control document_title" placeholder="Enter document title" name="property_documents[1][title]" value="" required>
                </div>
            </div>
            <!-- End Title -->

            <!-- Document File -->
            <div class="col">
                <div class="form-group">
                    <label for="document_file">Document File</label>
                    <input type="file" class="form-control document_file" name="property_documents[1][document_file]" required>
                </div>
            </div>
            <!-- End Document File -->
        </div>
    </div>
    <!-- End Static Property Documents Card -->
<?php    
    endif;
?>