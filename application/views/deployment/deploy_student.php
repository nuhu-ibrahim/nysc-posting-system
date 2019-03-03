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
                    alert("The students have been deplyoyed succesfully, advice them to print call-up letters");
                    window.location.href="<?php echo base_url('/admin'); ?>";
                </script>
            <?php } ?> 
            <?php if($batch->batch_id == '' ){?> 
                <div style="text-align:center; color:red;" class="box-header with-border">
                    <h3 class="box-title">No active batch, you cannot deploy students.</h3>
                </div>
            <?php }else{ ?>
                <div style="text-align:center;" class="box-header with-border">
                    <h3 class="box-title"><?php echo $sub_header ?></h3>
                </div>
                <?php echo form_open(); ?>
                    <div align = 'center' class="box-footer">
                        <?php echo form_submit('save', 'Deploy Students', array("class"=>"btn btn-primary", 'align'=>'center')); ?>
                    </div>  
                <?php echo form_close(); ?> 
            <?php } ?>  
        </div>
      </div>
      <!-- /.row -->
    </section>