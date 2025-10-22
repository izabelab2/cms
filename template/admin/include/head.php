<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <title>CMS - <?php echo $title; ?></title>
    <link rel="stylesheet" href="template/admin/css/style.css" type="text/css" />
	<script src="js/jq.js"></script>
	<script src="template/admin/js/script.js"></script>
	<!--<script src="js/html5.js"></script>
	<script src="js/scripts.js"></script>-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex, nofollow" />
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
	

	<script src="template/admin/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
			selector: "textarea",
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor"
			],
			toolbar1: "undo redo |  bold italic | alignleft aligncenter alignright alignjustify fontselect fontsizeselect",
			toolbar2: "bullist numlist outdent indent | link image code forecolor backcolor emoticons",
			menu: {},
			statusbar : false
		});
    </script>
</head>