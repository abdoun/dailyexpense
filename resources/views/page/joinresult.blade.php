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
	<div class="col-xs-6">
		<div id="qr_code" data-code="{{ $etiket[0]['kod'] }}"></div>
		<span>{{ $etiket[0]['kod'] }}</span>
	</div>
</div>
<script src="{{ asset('/js/qrcode.min.js') }}"></script>
<script>
var qrContainer = document.getElementById('qr_code');
if (qrContainer) {
	new QRCode(qrContainer, {
		text: qrContainer.getAttribute('data-code'),
		width: 150,
		height: 150
	});
	var qrCanvas = qrContainer.querySelector('canvas');
	if (qrCanvas) {
		var qrImage = document.createElement('img');
		qrImage.src = qrCanvas.toDataURL('image/png');
		qrImage.alt = 'QR code';
		qrContainer.innerHTML = '';
		qrContainer.appendChild(qrImage);
	}
}
javascript:PrintDiv_('etiket');
</script>
@endif