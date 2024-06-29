<?php include('include/header.php');?>
<link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/sweetalert/css/sweetalert.css">
<link href="<?php echo base_url('public/admin/') ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php include('include/sidebar.php');?>

<div class="content-body">
  <form method="post" action="<?= base_url(ADMIN_URL.'role_permission_process') ?>">
    <input type="hidden" name="role_id" value="<?= $role_detail->role_id ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">Set Permission</h4>
                                <h6>Role: <strong><?= $role_detail->role_name ?></strong></h6>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <button type="submit" class="btn btn-info btn-md" >Save Permission</button>
                            </div>
                        </div>

                        <div>
                          <?php if($this->session->flashdata('error_msg')) { ?>
                            <div class="alert alert-danger pd8">
                              <?php echo $this->session->flashdata('error_msg'); ?>
                            </div>
                          <?php } ?>
                          <?php if($this->session->flashdata('success_msg')) { ?>
                            <div class="alert alert-success pd8">
                              <?php echo $this->session->flashdata('success_msg'); ?>
                            </div>
                          <?php } ?>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="empTable">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">M.Id</th>
                                        <th>Module Name</th>
                                        <th class="nosort wd-50 text-center">Create</th>
                                        <th class="nosort wd-50 text-center">Edit</th>
                                        <th class="nosort wd-50 text-center">View</th>
                                        <th class="nosort wd-50 text-center">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                  <?php foreach ($module_list as $module) { ?>
                                  <tr>
                                    <td class="text-center"><?= $module->m_id ?></td>
                                    <td><?= $module->module_name ?></td>
                                    <td class="text-center">
                                      <input type="hidden" name="module_id[<?= $module->m_id ?>]" value="<?= $module->m_id ?>">
                                      <?php if($module->perm_create) { ?>
                                        <input type="checkbox" name="module[<?= $module->m_id ?>][rr_create]" value="1" <?php if($module->rr_create) { echo 'checked'; } ?> >
                                      <?php } ?>
                                    </td>
                                    <td class="text-center">
                                      <?php if($module->perm_edit) { ?>
                                        <input type="checkbox" name="module[<?= $module->m_id ?>][rr_edit]" value="1" <?php if($module->rr_edit) { echo 'checked'; } ?> >
                                      <?php } ?>
                                    </td>
                                    <td class="text-center">
                                      <?php if($module->perm_view) { ?>
                                        <input type="checkbox" name="module[<?= $module->m_id ?>][rr_view]" value="1" <?php if($module->rr_view) { echo 'checked'; } ?> >
                                      <?php } ?>
                                    </td>
                                    <td class="text-center">
                                      <?php if($module->perm_delete) { ?>
                                        <input type="checkbox" name="module[<?= $module->m_id ?>][rr_delete]" value="1" <?php if($module->rr_delete) { echo 'checked'; } ?> >
                                      <?php } ?>
                                    </td>
                                  </tr>
                                  <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
</div>

 <?php include('include/footer.php');?>  
 <script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>