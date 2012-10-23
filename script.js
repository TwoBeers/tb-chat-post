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

				$selector.data('speaker-id', $selector.attr('class'));

				var speaker_class = '#' + $chat.attr('id') + ' .chat-transcript .' + $selector.data('speaker-id');

				$('.hide',$selector).click ( function() {

					$selector.addClass('hidden');
					$(speaker_class).addClass('hidden');

					if (effect == 'slide')
						$(speaker_class).slideUp();
					else if (effect == 'fade')
						$(speaker_class).fadeOut();

				});

				$('.show',$selector).click ( function() {

					$selector.removeClass('hidden');
					$(speaker_class).removeClass('hidden');

					if (effect == 'slide')
						$(speaker_class).slideDown();
					else if (effect == 'fade')
						$(speaker_class).fadeIn();

				});

				$('.toleft',$selector).click ( function() {

					$selector.removeClass('rightalign');

					$(speaker_class).removeClass('rightalign');

				});

				$('.toright',$selector).click ( function() {

					$selector.addClass('rightalign');

					$(speaker_class).addClass('rightalign');

				});

			});

		});


	}


};

$(document).ready(function($){ tbChatScripts.init(tbChat_l10n.animation); });

})(jQuery);