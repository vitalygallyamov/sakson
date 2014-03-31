$(document).ready(function() {
	var timeId = false;
	var card = false;

	if($('.items .empty').length)
		$('.to_mail').hide();
	// var stopEvent = function stopEvent(evt) {
	// 	(evt && evt.stopPropagation) ? evt.stopPropagation() : window.event.cancelBubble = true;
	// };
	$('.catalog').on('click', '.center_col .izb, .izb-detail', function(e){
		e.stopPropagation();
	});

	$('.catalog').on('change', '.center_col .izb, .izb-detail', function(e){
		//e.stopPropagation();
		// e.preventDefault();

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

		var inIzb = $this.closest('.izb_block').length;

		timeId = setTimeout(function(){
			$.ajax({
				url: checked ? "/catalog/addToFavorites" : "/catalog/deleteFromFavorites",
				data: {id: id, type: type},
				success: function(data){
					if(inIzb)
						$.fn.yiiListView.update("catalog-list",{ajaxType: 'GET'});
					
				}
			});
		}, 400);

	});


	$('.catalog').on('click', '.media', function(e){
		e.preventDefault();
		// e.preventDefault();

		var $this = $(this),
			id = $this.data('id');

		if($this.hasClass('card')){
			$this.hide();
			$this.prev().fadeIn(500);
		}else{
			$this.hide();
			$this.next().fadeIn(500);
		}

		/*$.ajax({
			url: '/catalog/getDetailView',
			data: {id: id},
			success: function(res){
				// var $body = $(res).find('.media').html();
				// console.log($(res).find('.media'));
				$this.addClass('card').html(res);
			}
		});*/
	});

	/*$('.catalog .media').hover(function(){
		var $this = $(this);

		$this.find('.izb').show();
	}, function(){
		var $this = $(this);

		$this.find('.izb').hide();
	});*/
	
});
