<style>
.align_right
{
	text-align:right;
}
</style>
<script language="javascript">
	function printDiv(divID) {
		//Get the HTML of div
		var divElements = document.getElementById(divID).innerHTML;
		//Get the HTML of whole page
		var oldPage = document.body.innerHTML;
		//Reset the page's HTML with div's HTML only
		document.body.innerHTML ="<html><head><title></title></head><body>" + divElements + "</body>";
		//Print Page
		window.print();
		//Restore orignal HTML
		document.body.innerHTML = oldPage;	  
	}
	function PrintDiv_(divID) {
		var contents = document.getElementById(divID).innerHTML;
		var frame1 = document.createElement('iframe');
		frame1.name = "frame1";
		frame1.style.position = "absolute";
		frame1.style.top = "-1000000px";
		document.body.appendChild(frame1);
		var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
		frameDoc.document.open();
		frameDoc.document.write('<html><head><title></title>');
		frameDoc.document.write('</head><body>');
		frameDoc.document.write(contents);
		frameDoc.document.write('</body></html>');
		frameDoc.document.close();
		setTimeout(function () {
			window.frames["frame1"].focus();
			window.frames["frame1"].print();
			document.body.removeChild(frame1);
		}, 500);
		return false;
	}
</script>
<div class="row">
	<div class="col-md-4 col-sm-12 col-xs-12"><img src="{{ asset('assets/images/m_logo.png') }}" /> </div>
</div>
<div class="row">
	<div class="col-xs-12">
	<br />
	<p class="@if($msg=='thanks') bg-success @else bg-danger @endif">{{ trans("joinresult.$msg")}}</p>
	</div>
</div>
@if($etiket[0]['kod']!='')
<div class="row" id="etiket">
	<div class="col-xs-6 align_right">{{trans("join.name")}}:</div>	
	<div class="col-xs-6">{{$etiket[0]['name']}}</div>
	<div class="col-xs-6 align_right">{{trans("join.email")}}:</div>	
	<div class="col-xs-6">{{$etiket[0]['email']}}</div>
	<div class="col-xs-6 align_right">{{trans("join.book_name")}}:</div>	
	<div class="col-xs-6">{{$etiket[0]['book']}}</div>
	<div class="col-xs-6 align_right">{{trans("joinresult.start_date")}}</div>	
	<div class="col-xs-6">{{$etiket[0]['start_date']}}</div>
	<div class="col-xs-6 align_right">{{trans("join.code")}}:</div>	
	<div class="col-xs-6"><img src="https://chart.googleapis.com/chart?chs=150x150&amp;cht=qr&amp;chl={{$etiket[0]['kod']}}&amp;choe=UTF-8" alt="QR code" /></div>
</div>
<script>
javascript:PrintDiv_('etiket');
</script>
@endif