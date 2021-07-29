$(document).ready(function(){

	$('#item_thumbnail').filer({
		showThumbs: true,
		addMore: false,
		allowDuplicates: false,
		limit: 1,
        maxSize: 1,
        extensions: ["jpeg", "jpg", "png"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only jpeg, jpg, png images are allowed to be uploaded."
			}
		}

	});
	$('#item_preview').filer({
		showThumbs: true,
		addMore: false,
		allowDuplicates: false,
		limit: 1,
        maxSize: 1,
        extensions: ["jpeg", "jpg", "png"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only jpeg, jpg, png images are allowed to be uploaded."
			}
		}

	});
	$('#item_file').filer({
		showThumbs: true,
		addMore: false,
		allowDuplicates: false,
		limit: 1,
        maxSize: 1,
		extensions: ["zip"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only Zip file is allowed to be uploaded."
			}
		}
        

	});
	
	$('#video_file').filer({
		showThumbs: true,
		addMore: false,
		allowDuplicates: false,
		limit: 1,
        maxSize: 1,
		extensions: ["mp4"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only MP4 file is allowed to be uploaded."
			}
		}
        

	});
	
	$('#item_screenshot').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false,
		limit: null,
        maxSize: null,
        extensions: ["jpeg", "jpg", "png"],
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			errors: {
				filesType: "Only jpeg, jpg, png images are allowed to be uploaded."
			}
		}

	});
	

});
