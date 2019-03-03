    <section class="content-header">
        <h1  style="text-align:center;" >
            <?php echo $header ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8 col-md-offset-2">
          <!-- general form elements -->
          <div class="box box-primary">
            <?php if($is_active && !(isset($_GET['success']) && $_GET['success'] == "true")){?> 
                <div style="text-align:center; color:red;" class="box-header with-border">
                    <h3 class="box-title">An active batch exist, please reset the system to enter new batch information</h3>
                </div>
            <?php }else{ ?>
                <div style="text-align:center;" class="box-header with-border">
                    <h3 class="box-title"><?php echo $sub_header ?></h3>
                </div>
                <?php if(isset($_GET['success']) && $_GET['success'] == "true"){ ?>
                        <div class = "alert alert-success">
                            Batch Information Profiled Successfully.
                        </div>
                <?php } ?> 
                <?php echo form_open(); ?>
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
                        <?php if(form_error('batch_title')) {?>
                                <?php echo form_error('batch_title'); ?>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo form_label('Batch Title', 'batch_title'); ?>
                            <?php echo form_input('batch_title', $batch->batch_title, array("class"=>"form-control")); ?>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo form_submit('save', 'Add Batch Information', array("class"=>"btn btn-primary")); ?>
                    </div>  
                <?php echo form_close(); ?> 
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>