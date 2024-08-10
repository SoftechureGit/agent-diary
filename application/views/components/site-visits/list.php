<!-- Table View -->
<section class="site-visits-section">
    <div class="row">
        <div class="col-md-12">
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Followup By</th>
                            <th>Lead Status</th>
                            <th>Lead Stage</th>
                            <th>Like / Dislike</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!count($records)): ?>
                            <tr>
                                <td colspan="10" class="text-center">No records found</td>
                            </tr>
                        <?php endif; ?>
                        <?php
                        foreach ($records ?? [] as $key => $record):
                            if (is_array($record)):
                                $record = (object) $record;
                            endif;
                        ?>
                            <tr>
                                <td><?= ++$key; ?></td>
                                <td><?= $record->visit_date ?? '' ?></td>
                                <td><?= $record->lead_name ?? '' ?></td>
                                <td><?= $record->assign_to ?? '' ?></td>
                                <td><?= $record->lead_status_name ?? '' ?></td>
                                <td><?= $record->lead_stage_name ?? '' ?></td>
                                <td>
                                    <?php
                                    if ($record->interested ?? 0):
                                        if ($record->interested == 1):
                                            echo "<i class='fa fa-thumbs-up text-success'></i>";
                                        elseif ($record->interested == 2):
                                            echo "<i class='fa fa-thumbs-down text-danger'></i>";
                                        endif;
                                    endif;
                                    ?>

                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- End Table View -->