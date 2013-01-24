<!DOCTYPE html>
<html xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="Ian Lamb, ianlamb32@gmail.com" />
		<meta name="viewport" content="width=device-width" />
		<link rel="icon" href="<?=URL::base()?>/img/favicon.ico" type="image/ico" />
		<title>Vapour OS</title>

		<?=Asset::styles()?>
		<?=Asset::scripts()?>

		@yield('scripts')
	</head>
	<body>
		<!-- BEGIN TASKBAR -->
		<div id="taskbar">
			<div id="options" title="options">
				<ul>
					<li><?=HTML::link('user/logout', 'Logout')?></li>
				</ul>
			</div>
			<div id="tasks">
				
			</div>
			<div id="context-menu">
				<div class="vos-context-item-active"></div>
				<div id="vos-context-item-1" class="vos-context-item"></div>
				<div id="vos-context-item-2" class="vos-context-item"></div>
				<div id="vos-context-item-3" class="vos-context-item"></div>
				<div id="vos-context-item-4" class="vos-context-item"></div>
			</div>
		</div>
		<!-- END TASKBAR -->

		<!-- BEGIN CONTENT -->
		<div id="content">
			@yield('content')
		</div>
		<!-- END CONTENT -->
	</body>
</html>