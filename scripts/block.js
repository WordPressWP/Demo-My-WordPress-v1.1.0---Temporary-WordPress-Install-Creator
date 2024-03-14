"use strict"; 
var { registerBlockType } = wp.blocks;
var gcel = wp.element.createElement;

registerBlockType( 'demo-my-wordpress/dwp-list', {
    title: 'Demo My WordPress Form',
    icon: 'feedback',
    category: 'embed',
    attributes: {
        switch_theme : {
            default: '',
            type:   'string',
        },
        activate_plugins : {
            default: '',
            type:   'string',
        }
    },
    keywords: ['list', 'posts', 'demo'],
    edit: (function( props ) {
        var switch_theme = props.attributes.switch_theme;
        var activate_plugins = props.attributes.activate_plugins;
        function updateMessage( event ) {
            props.setAttributes( { switch_theme: event.target.value} );
		}
        function updateMessage2( event ) {
            props.setAttributes( { activate_plugins: event.target.value} );
		}
		return gcel(
			'div', 
			{ className: 'coderevolution_gutenberg_div' },
            gcel(
				'h4',
				{ className: 'coderevolution_gutenberg_title' },
                'Demo My WordPress Form ',
                gcel(
                    'div', 
                    {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                    ,
                    gcel(
                        'div', 
                        {className:'bws_hidden_help_text'},
                        'This block is used to add the "Demo My WordPress Form" form to the page.'
                    )
                )
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Theme Stylesheet Name To Activate: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Stylesheet name of the theme to activate.'
                )
            ),
			gcel(
				'input',
				{ type:'text',placeholder:'Theme stylesheet name', value: switch_theme, onChange: updateMessage, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Plugin Names To Activate: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Commma separated list of plugin names to activate.'
                )
            ),
			gcel(
				'input',
				{ type:'text',placeholder:'Theme stylesheet name', value: activate_plugins, onChange: updateMessage2, className: 'coderevolution_gutenberg_input' }
			)
        );
    }),
    save: (function( props ) {
       return null;
    }),
} );