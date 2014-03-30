$(document).ready(function() {
	var timeId = false;
	$('.catalog').on('change', '.center_col .izb', function(e){
		var $this = $(this),
			id = $this.data('id'),
			type = $this.data('type');

		var checked = $this.find('input[type=checkbox]').is(':checked');

		checked ? $this.attr('title', "Удалить из избранного") : $this.attr('title', "Добавить в избранное");

		if(timeId) clearTimeout(timeId);

		if(!checked && $this.closest('.izb_block').length){
			$this.closest('.media').hide(300, function(){
				$(this).remove();

			});
		}

		timeId = setTimeout(function(){
			$.ajax({
				url: checked ? "/catalog/addToFavorites" : "/catalog/deleteFromFavorites",
				data: {id: id, type: type},
				success: function(){
					jQuery('#catalog-list').yiiListView('update');
				}
			});
		}, 400);
	});

	/*$('.catalog .media').hover(function(){
		var $this = $(this);

		$this.find('.izb').show();
	}, function(){
		var $this = $(this);

		$this.find('.izb').hide();
	});*/
	
});
