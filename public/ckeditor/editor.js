const watchdog = new CKSource.Watchdog();
		
		window.watchdog = watchdog;
		
		watchdog.setCreator( ( element, config ) => {
			return CKSource.Editor
				.create( element, config )
				.then( editor => {

					return editor;
				} )
		} );
		
		watchdog.setDestructor( editor => {
			return editor.destroy();
		} );
		
		watchdog.on( 'error', handleError );
		
		watchdog
			.create( document.querySelector( '.editor' ), {
				
				toolbar: {
					items: [
						'undo',
						'redo',
						'|',
						'heading',
						'|',
						'bold',
						'italic',
						'underline',
						'strikethrough',
						'subscript',
						'superscript',
						'|',
						'fontSize',
						'fontColor',
						'fontFamily',
						'fontBackgroundColor',
						'highlight',
						'|',
						'todoList',
						'bulletedList',
						'numberedList',
						'alignment',
						'outdent',
						'indent',
						'|',
						'imageInsert',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'link',
						'|',
						'code',
						'codeBlock',
						'-',
						'removeFormat',
						'horizontalLine',
						'htmlEmbed',
						'specialCharacters',
						'pageBreak',
                        ''
					],
					shouldNotGroupWhenFull: true
				},
				language: 'ro',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side',
						'linkImage'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells',
						'tableCellProperties',
						'tableProperties'
					]
				},
				licenseKey: '',
				
				
			} )
			.catch( handleError );
		
		function handleError( error ) {
			console.error( 'Oops, something went wrong!' );
			console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
			console.warn( 'Build id: a7ra20bhqp5r-nd22pl4xie1u' );
			console.error( error );
		}
