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
            <?php if(isset($_GET['success']) && $_GET['success'] == "true"){ ?>
                <script>
                    alert("The system has been reset successfully, you can enter new batch information");
                    window.location.href="<?php echo base_url('/add-batch'); ?>";
                </script>
            <?php } ?> 
            <?php if($batch->batch_id == '' ){?> 
                <div style="text-align:center; color:red;" class="box-header with-border">
                    <h3 class="box-title">No active batch, please go ahead to profile new batch information</h3>
                </div>
            <?php }else{ ?>
                <div style="text-align:center;" class="box-header with-border">
                    <h3 class="box-title"><?php echo $sub_header ?></h3>
                </div>
                <?php echo form_open(); ?>
                    <div align = 'center' class="box-footer">
                        <?php echo form_submit('save', 'Reset System', array("class"=>"btn btn-primary", 'align'=>'center')); ?>
                    </div>  
                <?php echo form_close(); ?> 
            <?php } ?>  
        </div>
      </div>
      <!-- /.row -->
    </section>