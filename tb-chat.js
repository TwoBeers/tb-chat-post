var tbChatScripts;

(function($) {

tbChatScripts = {

	init : function(effect) {

		$('.tb-chat').each( function() {

			var $chat = $(this);

			$chat.addClass('animated');

			var $selectors = $('.chat-select li',this);

			$selectors.each( function() {

				var $selector = $(this);

				$selector.data('chatter-id', $selector.attr('class'));

				var chatter_class = '#' + $chat.attr('id') + ' .chat-transcript .' + $selector.data('chatter-id');

				$('.hide',$selector).click ( function() {

					$selector.addClass('hidden');
					$(chatter_class).addClass('hidden');

					if (effect == 'slide')
						$(chatter_class).slideUp();
					else if (effect == 'fade')
						$(chatter_class).fadeOut();

				});

				$('.show',$selector).click ( function() {

					$selector.removeClass('hidden');
					$(chatter_class).removeClass('hidden');

					if (effect == 'slide')
						$(chatter_class).slideDown();
					else if (effect == 'fade')
						$(chatter_class).fadeIn();

				});

				$('.toleft',$selector).click ( function() {

					$selector.removeClass('rightalign');

					$(chatter_class).removeClass('rightalign');

				});

				$('.toright',$selector).click ( function() {

					$selector.addClass('rightalign');

					$(chatter_class).addClass('rightalign');

				});

			});

		});


	}


};

$(document).ready(function($){ tbChatScripts.init(tbChat_l10n.animation); });

})(jQuery);