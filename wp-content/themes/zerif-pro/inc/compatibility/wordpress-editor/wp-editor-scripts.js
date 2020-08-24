/* global wpEditor */
(function ( $ ) {
	var url;

	$.wpEditor = {

		init: function(){
			this.setTemplateClass();
			this.manipulateDom();
			this.getFeaturedImage();
		},

		/**
		 * Set template class on editor.
		 */
		setTemplateClass: function(){
			var editorContainer     = $( '#editor' );
			var pageTemplate = this.getTemplateClass();
			editorContainer.addClass( 'page-template-' + pageTemplate );
			this.handleTemplateChange();
		},

		/**
		 * Update class on editor.
		 */
		handleTemplateChange: function(){
			var editorContainer     = $( '#editor' ),
				templateSelectClass = '.editor-page-attributes__template select';
			var th = this;
			editorContainer
				.on( 'change.set-editor-class', templateSelectClass, function() {
					var pageTemplate = th.getTemplateClass();

					editorContainer
						.removeClass( function( index, className ) {
							return ( className.match( /\bpage-template-[^ ]+/ ) || [] ).join( ' ' );
						} )
						.addClass( 'page-template-' + pageTemplate );

					$('.zelle-gtb-sidebar').remove();
					$('body').removeClass('zelle-header-template');
					th.handleSidebar();
					th.updateHeaderClass();
					th.setFeaturedImage(url);
				} )
				.find( templateSelectClass ).trigger( 'change.set-editor-class' );
		},

		/**
		 * Get page template class.
		 * @returns {string}
		 */
		getTemplateClass:function(){
			var defaultTemplate = 'default';
			if( wpEditor.initial_template !== '' && ! $('#editor').is('div[class*="page-template"]')){
				defaultTemplate = wpEditor.initial_template;
			}
			var templateSelectClass = '.editor-page-attributes__template select';
			var pageTemplate = $( templateSelectClass ).val() || defaultTemplate;
			pageTemplate = pageTemplate
				.substr( pageTemplate.lastIndexOf( '/' ) + 1, pageTemplate.length )
				.replace( /\.php$/, '' )
				.replace( /\./g, '-' );
			return pageTemplate;
		},
		
		manipulateDom: function (  ) {
			this.addClasses();
			this.handleSidebar();
		},
		
		addClasses: function (  ) {
			var editor = $( '.editor-styles-wrapper' );
			$( editor ).addClass( 'zelle-gtb' );
			$( '.editor-writing-flow > div:not(.wp-block)' ).addClass( 'zelle-content-wrap' );
			$( '.editor-writing-flow > div > div' ).addClass( 'zelle-blocks-wrap' );
			$('.editor-block-list__layout').wrap( '<div class="zelle-editor-wrapper"></div>');
			this.updateHeaderClass();
		},

		updateHeaderClass: function(){
			$( 'body' ).removeClass( 'zelle-header-template' );
			if( wpEditor.has_header === '1' && this.isBlogTemplate() ) {
				$( 'body' ).addClass( 'zelle-header-template' );
			}
		},

		/**
		 * Get the sidebar markup.
		 */
		getSidebarMarkup: function (position) {
			return '<div class="zelle-gtb-sidebar '+ position +'"><p>' + wpEditor.strings.sidebar + '</p></div>';
		},

		isBlogTemplate: function(){
			return $('#editor').hasClass('page-template-template-blog-large') || $('#editor').hasClass('page-template-template-blog');
		},

		pageHasTopImage: function(){
			return this.isBlogTemplate() && wpEditor.has_header === '1';
		},

		/**
		 * Handle sidebar setup.
		 */
		handleSidebar: function () {
			var position = wpEditor.sidebar_position;

			if( wpEditor.all_page_full === '1' ){
				position = 'full-width';
			}

			if( this.isBlogTemplate() ){
				position = wpEditor.sidebar_position;
			} else {
				if( $('body').hasClass('post-type-page') && wpEditor.all_page_full !== '1' ){
					position = 'sidebar-right';
				}
			}

			if( position === 'full-width' ){
				return;
			}

			var editor = $( '.editor-styles-wrapper' );
			switch ( position ) {
				case 'sidebar-right':

					$( editor ).removeClass( 'has-sidebar-left' );
					$( editor ).addClass( 'has-sidebar-right' );

					if( this.pageHasTopImage() ){
						$( '.zelle-editor-wrapper' ).append( this.getSidebarMarkup( position ) );
					} else {
						$( '.zelle-blocks-wrap' ).after( this.getSidebarMarkup( position ) );
					}
					break;
				case 'sidebar-left':
					$( editor ).removeClass( 'has-sidebar-right' );
					$( editor ).addClass( 'has-sidebar-left' );

					if( this.pageHasTopImage() ){
						$('.zelle-editor-wrapper').prepend( this.getSidebarMarkup( position ) );
					} else {
						$('.zelle-blocks-wrap').before( this.getSidebarMarkup(position) );
					}
					break;
			}
		},

		/**
		 *  A function that triggers when featured image is changed.
		 */
		getFeaturedImage: function () {
			var editor_class = $('#editor').attr('class').match(/page[\w-]*\b/);
			var template_name = editor_class.toString().replace('page-template-','');

			var acceptedTemplates = ['default','template-blog', 'template-blog-large'];
			if( ! acceptedTemplates.includes( template_name ) ){
				return;
			}

			var th = this;
			var mutationObserver = new MutationObserver(function(mutations) {
				mutations.forEach( function ( mutation ) {
					if( mutation.target.className === 'components-responsive-wrapper__content'){
						url = mutation.target.currentSrc;
						if( typeof url !== 'undefined' ){
							th.setFeaturedImage( url );
							return false;
						}
					}
					if ( mutation.target.className === 'editor-post-featured-image') {
						url = $( mutation.target ).find( 'img' ).attr( 'src' );
						if( $( mutation.target ).find( 'img' ).length > 0 ) {
							if ( typeof url !== 'undefined' ) {
								th.setFeaturedImage( url );
								return false;
							}
						} else{
							url = '';
							if( ( $('#editor').hasClass('page-template-template-blog-large') ||
								$('#editor').hasClass('page-template-template-blog') ) &&
								wpEditor.has_header === '1' ) {
								url = wpEditor.header_image;
							}
							th.setFeaturedImage( url );
						}
					}
				});
			});

			// Starts listening for changes in the root HTML element of the page.
			mutationObserver.observe($( '.edit-post-layout' )[ 0 ],
				{
					attributes: true,
					childList: true,
					subtree: true,
				}
			);

			url = wpEditor.header_image;
			if( ( $('#editor').hasClass('page-template-template-blog-large') ||
				$('#editor').hasClass('page-template-template-blog') ) &&
				wpEditor.has_header === '1' ){
				url = wpEditor.header_image;
				th.setFeaturedImage(wpEditor.header_image);
			}
			return false;
		},

		setFeaturedImage: function ( url ) {
			$('.header-has-background').css('background-image','none');
			$('.header-has-background').removeClass('header-has-background');
			$('.thumb-in-page-content').remove();
			if( typeof url === 'undefined' || url === '' ){
				return;
			}
			url = url.replace('-250x250','');
			if( this.isBlogTemplate() && wpEditor.has_header === '1' ){
				var selector = 'body.zelle-header-template .editor-writing-flow > div > div > div:not(.editor-block-list__layout):not(.zelle-editor-wrapper)';
				$(selector).addClass('header-has-background');
				$(selector).css('background-image','url('+url+')');
			} else {
				if( ( ($('body').hasClass('post-type-page') && wpEditor.thumb_page === '1') ||
					($('body').hasClass('post-type-post') && wpEditor.thumb_post === '1') ) &&
					! $('#editor').hasClass('page-template-template-blog-large') &&
					! $('#editor').hasClass('page-template-template-blog')
				){
					$('.editor-block-list__layout').prepend('<img class="thumb-in-page-content" src="'+url+'" alt="Thumbnail image"/>');
				}
			}
		}
	};
})(jQuery);

wp.domReady( function() {
	jQuery.wpEditor.init();
});