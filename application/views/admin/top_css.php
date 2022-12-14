<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'common/assets/images/favicon.png'; ?>">
<!-- Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url() . 'common/dist/css/style.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'common/icofont/icofont.min.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'common/dist/css/custom.css'; ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'common/node_modules/sweetalert2/dist/sweetalert2.min.css'; ?>">
</link>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/libs/select2/dist/css/select2.min.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';?>">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
	/*table center align*/
	.textcen {
		text-align: center;
	}

	.blink_renewal {
		animation: blinker 1s linear infinite;
		color: #f06359;
	}

	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}

	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* Firefox */
	input[type=number] {
		-moz-appearance: textfield;
	}
</style>