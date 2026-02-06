( function ( wp ) {
	const { registerBlockType } = wp.blocks;
	const { __ } = wp.i18n;
	const { RichText, useBlockProps } = wp.blockEditor;

	registerBlockType( 'g224/spotlight-card', {
		title: __( 'Spotlight Card', 'g224' ),
		icon: 'megaphone',
		category: 'text',
		attributes: {
			title: {
				type: 'string',
				default: 'Ship with clarity',
			},
			summary: {
				type: 'string',
				default:
					'Pattern overrides let each instance customize this text without breaking the synced pattern.',
			},
		},
		edit: ( { attributes, setAttributes } ) => {
			const { title, summary } = attributes;
			const blockProps = useBlockProps( {
				className: 'g224-spotlight-card',
			} );

			return (
				<div { ...blockProps }>
					<RichText
						tagName="h3"
						className="g224-spotlight-card__title"
						value={ title }
						onChange={ ( nextTitle ) => setAttributes( { title: nextTitle } ) }
						placeholder={ __( 'Add a headline…', 'g224' ) }
					/>
					<RichText
						tagName="p"
						className="g224-spotlight-card__summary"
						value={ summary }
						onChange={ ( nextSummary ) => setAttributes( { summary: nextSummary } ) }
						placeholder={ __( 'Add supporting copy…', 'g224' ) }
					/>
				</div>
			);
		},
		save: () => null,
	} );
} )( window.wp );
