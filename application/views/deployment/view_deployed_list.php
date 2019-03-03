    <section class="content-header">
        <h1  style="text-align:center;" >
            <?php echo $header ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10 col-md-offset-1">
          <!-- general form elements -->
          <div class="box box-primary">
            <?php if($is_active == 0){ ?>
                <div style="text-align:center; color:red;" class="box-header with-border">
                    <h3 class="box-title">No active batch, you cannot view deployed list.</h3>
                </div>
            <?php }else{ ?>
                <div style="text-align:center;" class="box-header with-border" >
                    <h3 class="box-title"><?php echo $sub_header; ?></h3>
                </div> 
                <?php echo form_open_multipart(); ?>
                    <div class="box-body">
                        <?php if(count($error) > 0){ ?>
                            <?php foreach($error as $er){ ?>
                                <div class = "alert alert-error">
                                    <?php echo $er ?>
                                </div>
                        <?php 
                            } 
                        } 
                        ?> 
                        <?php if(form_error('state_id')) {?>
                                <?php echo form_error('state_id'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Select State', 'state_id'); ?>
                            <?php echo form_dropdown('state_id', $states, $state->state_id, array("class"=>"form-control")); ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('save', 'View Deployed Students', array("class"=>"btn btn-primary")); ?>
                    </div>  
                <?php echo form_close(); ?> 
                <?php if(isset($deployed_students)): ?>
                    <?php if(count($deployed_students) > 0): ?>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Matric Number</th>
                                    <th>Institution</th>
                                    <th>Batch</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Deployed State</th>
                                    <th>PPA</th>
                                    <th>Date of Birth</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 0 ?>
                                <?php foreach($deployed_students as $student) { ?>
                                    <tr>
                                        <?php $num=$num+1  ?>
                                        <td><?php echo $num ?></td>
                                        <td><?php echo $student['matric_number'] ?></td>
                                        <td><?php echo $student['institution_title'] ?></td>
                                        <td><?php echo $student['batch_title'] ?></td>
                                        <td><?php echo $student['firstname'] ?></td>
                                        <td><?php echo $student['middlename'] ?></td>
                                        <td><?php echo $student['lastname'] ?></td>
                                        <td><?php echo $student['state_title'] ?></td>
                                        <td><?php echo $student['ppa_name'] ?></td>
                                        <td><?php echo $student['dob'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Matric Number</th>
                                    <th>Institution Name</th>
                                    <th>Batch</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Deployed State</th>
                                    <th>PPA</th>
                                    <th>Date of Birth</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php else: ?>
                        <h1 align="center">No student has been deployed to this state in the active batch.</h1>
                    <?php endif; ?>
                <?php endif; ?>
            <?php } ?> 
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>