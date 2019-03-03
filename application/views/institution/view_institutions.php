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
            <div style="text-align:center;" class="box-header with-border" >
              <h3 class="box-title"><?php echo $sub_header ?></h3>
            </div> 
            <?php if($institutions): ?>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Institution Title</th> 
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num = 0 ?>
                        <?php foreach($institutions as $institution) { ?>
                            <tr>
                                <td><?php echo ++$num ?></td>
                                <td><?php echo $institution->institution_title ?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo base_url('/edit-institution'); ?>/<?php echo $institution->id ?>">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/No</th>
                            <th>Institution Title</th>
                            <th>Action</th> 
                        </tr>
                    </tfoot>
                </table>
            <?php else: ?>
                <h1 align="center">No institution yet!.</h1>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>