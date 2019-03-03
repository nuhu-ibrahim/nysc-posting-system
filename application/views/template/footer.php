</div>
  <!-- /.content-wrapper --> 
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018 <a href="">NYSC System</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<style>
    body {
        margin-top: 20px;
    }

    .panel-body:not(.two-col) {
        padding: 0px;
    }

    .glyphicon {
        margin-right: 5px;
    }

    .glyphicon-new-window {
        margin-left: 5px;
    }

    .panel-body .radio, .panel-body .checkbox {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .panel-body .list-group {
        margin-bottom: 0;
    }

    .margin-bottom-none {
        margin-bottom: 0;
    }

    .panel-body .radio label, .panel-body .checkbox label {
        display: block;
    }
</style>
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/ui/'); ?>js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/ui/'); ?>js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/ui/'); ?>js/raphael.min.js"></script>
<script src="<?php echo base_url('assets/ui/'); ?>js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/ui/'); ?>js/moment.min.js"></script>
<script src="<?php echo base_url('assets/ui/'); ?>js/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/ui/'); ?>js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/ui/'); ?>js/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/ui/'); ?>js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/ui/'); ?>js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/ui/'); ?>js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/ui/'); ?>js/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/ui/'); ?>js/demo.js"></script>
<script src="<?php echo base_url('assets/ui/'); ?>js/accounting.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type = "text/javascript" >
    function goto(param){
        result=confirm('Delete post/seat?. Note that deleting a post will cause all assciated votes and candidates to be deleted.');
        if(result){
            window.location.href=param;
        }
    }
    
    function goto1(param){
        result=confirm('Delete candidate?. Note that deleting a candidate will cause all associated votes to be deleted.');
        if(result){
            window.location.href=param;
        }
    }
    
    function goto8(){
        result=confirm('Submit vote?. Note that you cannot edit after you submit.');
        if(result){
            document.myForm.action = "<?php echo base_url('/vote'); ?>"
            document.myForm.submit();
        }
    }
</script>

<!--script src="<?php echo base_url('assets/ui/'); ?>js/jquery.datetimepicker.full.js"></script>
<script>
/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: "D, l, M, F, Y-m-d H:i:s"});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5
});
$('#datetimepicker2').datetimepicker({
	yearOffset:0,
	lang:'ch',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y-m-d',
	//minDate:'-1970/01/02', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker33').datetimepicker({
	yearOffset:0,
	lang:'ch',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y-m-d',
	//minDate:'-1970/01/02', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker3').datetimepicker({
	inline:true
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00'],
	step:5
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function(){
	if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	}else{
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function( currentDateTime ){
	if (currentDateTime && currentDateTime.getDay() == 6){
		this.setOptions({
			minTime:'11:00'
		});
	}else
		this.setOptions({
			minTime:'8:00'
		});
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime:logic,
	onShow:logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
	},
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
$('#datetimepicker9').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date.xdsoft_weekend')
			.addClass('xdsoft_disabled');
	},
	weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
	timepicker:false
});
var dateToDisable = new Date();
	dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [false, ""]
		}

		return [true, ""];
	}
});
$('#datetimepicker12').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [true, "custom-date-style"];
		}

		return [true, ""];
	}
});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})


</script-->
</body>
</html>
