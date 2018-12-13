//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType} = wp.blocks; // Import registerBlockType() from wp.blocks
const { SelectControl } = wp.components;
const { Component } = wp.element;

class mySelectForms extends Component {
	
	// Method for setting the initial state.
	static getInitialState( selectedForm ) {
		return {
		hb_forms: hatchbuck_forms,
		selectedForm: selectedForm,
		hb_form: {}, 
		};
	}
	
	  // Constructing our component. With super() we are setting everything to 'this'.
	  // Now we can access the attributes with this.props.attributes
	  constructor() {
		super( ...arguments );
		// Maybe we have a previously selected form. Try to load it.
		this.state = this.constructor.getInitialState(this.props.attributes.selectedForm );
		
		if(hatchbuck_forms && 0 !== this.state.selectedForm ) {
			// If we have a selected Form, find that post and add it.
			const hb_form = hatchbuck_forms.find( ( item ) => { return item.id == this.state.selectedForm } );
			// This is the same as { hb_form: hb_form, hb_forms: posts }
			this.setState( { hb_form: hb_form, hb_forms:hatchbuck_forms } );
		  } else {
			this.setState({ hb_forms:hatchbuck_forms });
		  }
		
		this.onChangeSelectForm = this.onChangeSelectForm.bind(this);
	  }
	  
	onChangeSelectForm( value ) {
		// Find the post
		const hb_form = this.state.hb_forms.find( ( item ) => { return item.id == parseInt( value ) } );
		
		if(0 !== hb_form.value) {
			// Set the state
			this.setState( { selectedForm: parseInt( value ), hb_form } );
			// Set the attributes
			this.props.setAttributes( {
			  selectedForm: parseInt( value ),
			  title: hb_form.title,
			  content: hb_form.content,
			  short_code: hb_form.short_code,
			});
		} else {
			// Set the state
			this.setState( { selectedForm: parseInt( value ), hb_form } );
			// Set the attributes
			this.props.setAttributes( {
			  selectedForm: parseInt( value ),
			  title: "Select a Form",
			  content: "No Hatchbuck Form Selected",
			  short_code: "Select a Hatchbuck Form",
			});
		}
	}
	
	render() {
	// Options to hold all loaded posts. For now, just the default.
	let options = [ { value: 0, label: __( 'Select a Form' ) } ];
	//let options = [];
	let output  = __( 'Loading Hatchbuck Forms' );
	
	if( this.state.hb_forms.length > 0 ) {
      const loading = __( 'We have %d forms. Choose one.' );
      output = loading.replace( '%d', this.state.hb_forms.length );
      this.state.hb_forms.forEach((hb_form) => {
        options.push({value:hb_form.id, label:hb_form.title});
      });
     } else {
       output = __( 'No Hatchbuck Forms found. Please create some first.' );
     }
	 
       output = __( this.props.attributes.short_code );
	   
	 // Checking if we have anything in the object
    //if( this.state.hb_form.hasOwnProperty('title') ) {
    //  output = <div>
    //    <p dangerouslySetInnerHTML={ { __html: this.state.hb_form.short_code } }></p>
     //   </div>;
   // } else {
     //  output = __( this.props.attributes.short_code );
    //}
	
    return [
    // If we are focused on this block, create the inspector controls.
      !! this.props.isSelected && (
        <SelectControl 
        // Selected value.
		onChange={this.onChangeSelectForm} 
        value={ this.props.attributes.selectedForm } 
        label={ __( 'Select a Form' ) } 
        options={ options } />
      ), 
		output
     ]
	}
}

registerBlockType( 'cgb/block-gutenberg-form-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Hatchbuck Forms' ), // Block title.
	icon: 'shield', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'Hatchbuck' ),
		__( 'Load' ),
		__( 'Hatchbuck Forms' ),
	],
	
	attributes: {
		content: {
		  type: 'array',
		  source: 'children',
		  selector: 'p',
		},
		title: {
		  type: 'string',
		  selector: 'h2'
		},
		short_code: {
		  type: 'string',
		  selector: 'p'
		},
		selectedForm: {
		  type: 'number',
		  default: 0,
		},
	},

	edit: mySelectForms,

	save: function( props ) {
		return (
			 props.attributes.short_code
		);
	},
} );
