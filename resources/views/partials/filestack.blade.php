		<!-- function show is listed below: onchange, the uploaded photo will display in your customized view... -->
		<!-- <input  type="filepicker" onchange="showImage();"> -->

<div id="container">
		<img id="uploadedImage" src="">
</div>

</script>
		<!-- This line of code must be included in your design: It makes the call to your filestack javascript library -->
<script type="text/javascript" src="//api.filestackapi.com/filestack.js"></script>

		<!--  The following lines of code will set the key(it will accept my API Key) -->
<script>
	filepicker.setKey(AHtuHxJJyS2ijt2rx4ZH1z);
		// The function showImage allows the image you upload to be displayed in your html... the src that you upload ties to src = event.fpfile.url and plugs it into your src="" on line 11...

	function showImage(){
		document.getElementById('uploadedImage').src = event.fpfile.url;
	}
</script>

		<!-- The widgets documentation for data-fp-crop-dim can be found at filestack.com/docs/file-ingestion/widgets/drag-drop
		data-fp-crop-dim sets the crop dimension to whatever size you set it. for example data-fp-crop-dim="500,500" gives you a photo that with a width of 500px x height 500px -->


<input type="filepicker-dragdrop" data-fp-button-text="Tangle Your Photos!" onchange="showImage();" data-fp-multiple="true" data-fp-crop-dim="300,300" data-fp-apikey="AHtuHxJJyS2ijt2rx4ZH1z" data-fp-mimetypes="image/*" data-fp-container="modal" data-fp-multiple="true" onchange="out='';for(var i=0;i<event.fpfiles.length;i++){out+=event.fpfiles[i].url;out+=' '};alert(out)"><h3>Choose the photos you love!</h3>

