// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.carousel', {
		// creates control instances based on the control's id.
		// our button's id is "carousel_button"
		createControl : function(id, controlManager) {
			if (id == 'carousel_button') {
				// creates the button
				var button = controlManager.createButton('carousel_button', {
					title : 'Carousel Shortcode', // title of the button
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;						
						tb_show( 'Add Carousel', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=carousel-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin.
	tinymce.PluginManager.add('carousel', tinymce.plugins.carousel);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked		
		var form = jQuery('<div id="carousel-form"><table id="carousel-table" class="form-table">\
			<tr>\
				<th><label for="carousel-title">Title</label></th>\
				<td><input type="text" name="title" id="carousel-title" value="" /><br />\
			</tr>\
			<tr>\
				<th><label for="carousel-tag">Title Tag</label></th>\
				<td><input type="text" name="tag" id="carousel-tag" value="h1" /><br />\
			</tr>\
			<tr>\
				<th><label for="carousel-content">Content</label></th>\
				<td><textarea name="content" id="carousel-content"></textarea><br />\
			</tr>\
			<tr>\
				<th><label for="carousel-button_text">Button Text</label></th>\
				<td><input type="text" name="button_text" id="carousel-button_text" value="Read More" /><br />\
			</tr>\
			<tr>\
				<th><label for="carousel-link">Button Link</label></th>\
				<td><input type="text" name="link" id="carousel-link" /><br />\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="carousel-submit" class="button-primary" value="Insert Carousel" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#carousel-submit').click(function(){
			// defines the options and their default values			
			var options = {
				'title'	 		: '',
				'tag'    		: 'h1',
				'content'    	: '',
				'button_text'	: 'Read More',
				'link'			: '',						
				};
			var shortcode = '[carousel';
			
			for( var index in options) {
				var value = table.find('#carousel-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()