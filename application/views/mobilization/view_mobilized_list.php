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
                    <h3 class="box-title">No active batch, you cannot view mobilized list.</h3>
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
                        <?php if(form_error('institution_id')) {?>
                                <?php echo form_error('institution_id'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Select Institution', 'institution_id'); ?>
                            <?php echo form_dropdown('institution_id', $institutions, $institution->id, array("class"=>"form-control")); ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('save', 'View Mobilized Students', array("class"=>"btn btn-primary")); ?>
                    </div>  
                <?php echo form_close(); ?> 
                <?php if(isset($mobilized_students)): ?>
                    <?php if(count($mobilized_students) > 0): ?>
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
                                    <th>Date of Birth</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 0 ?>
                                <?php foreach($mobilized_students as $student) { ?>
                                    <tr>
                                        <?php $num=$num+1  ?>
                                        <td><?php echo $num ?></td>
                                        <td><?php echo $student['matric_number'] ?></td>
                                        <td><?php echo $institutions[$institution->id] ?></td>
                                        <td><?php echo $student['batch_title'] ?></td>
                                        <td><?php echo $student['firstname'] ?></td>
                                        <td><?php echo $student['middlename'] ?></td>
                                        <td><?php echo $student['lastname'] ?></td>
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
                                    <th>Date of Birth</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php else: ?>
                        <h1 align="center">No mobilized student from the institution in the active batch.</h1>
                    <?php endif; ?>
                <?php endif; ?>
            <?php } ?> 
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>