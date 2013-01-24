@layout('master')

@section('scripts')
	<script src="<?=URL::base()?>/js/vapour.js"></script>
	<script src="<?=URL::base()?>/js/jgestures.min.js"></script>
	<script src="<?=URL::base()?>/js/fileuploader.js"></script>
@endsection

@section('content')
	<div class="vos-context" id="context-1">
		<?//=Form::file('image')?>
		
		@foreach($user->files as $file)
			<div class="vos-icon" id="file-<?=$file->id?>">
				<img src="<?=URL::base().'/files/'.$file->url?>" alt="<?=$file->url?>" class="vos-icon-img" />
				<div class="vos-icon-label"><?=$file->url?></div>
			</div>
		@endforeach
		
		<div class="vos-window" id="window-1">
			<div class="vos-window-title">
				Test Window 1
				<div class="vos-window-controls">
					<i class="icon-remove"></i>
				</div>
			</div>
			<div class="vos-window-body">
				
			</div>
		</div>
		
		<div class="vos-window" id="window-2">
			<div class="vos-window-title">
				Test Window 2
				<div class="vos-window-controls">
					<i class="icon-remove"></i>
				</div>
			</div>
			<div class="vos-window-body">
				
			</div>
		</div>
		
		<div class="vos-window" id="window-3">
			<div class="vos-window-title">
				Test Window 3
				<div class="vos-window-controls">
					<i class="icon-remove"></i>
				</div>
			</div>
			<div class="vos-window-body">
				
			</div>
		</div>
	</div>
@endsection

<script type="text/javascript">
		
</script> 