
// generate CSS for given block selectors
function generate_block_css (selectors, id, responsiveType = "" ) {

	let gen_styling_css  = "";
	let res_styling_css  = "";

	// generate style for all resolutions
	for( let i in selectors ) {

		let sel = selectors[i];
		let css = "";

		for( let j in sel ) {

			let checkString = true;
			
			if ( typeof sel[j] === "string" && sel[j].length === 0 && j !== 'content' ) {
				checkString = false;
			}

			if ( typeof sel[j] != "undefined" && checkString ) {
				css += j + ": " + sel[j] + ";";
			}
		}

		if ( css.length !== 0 ) {
			gen_styling_css += id + i + "{" + css + "}";
		}
	}

	// add media query for non-desktop resolution
	// noinspection JSUnresolvedVariable
	let media = '';
	
	if ( responsiveType === "mobile" ) {
		media = "(max-width: " + epbl_blocks_configuration.mobile_breakpoint + "px)";
	} else if ( responsiveType === "tablet" ) {
		media = "(max-width: " + epbl_blocks_configuration.tablet_breakpoint + "px)";
	} else if ( responsiveType === "only_desktop" ) {
		media = "(min-width: " + ( epbl_blocks_configuration.tablet_breakpoint +1 ) + "px)";
	} else if ( responsiveType === "only_tablet" ) {
		media = "(max-width: " + epbl_blocks_configuration.tablet_breakpoint + "px) and (min-width: " + ( epbl_blocks_configuration.mobile_breakpoint +1 ) + "px)";
	}
	
	
	if ( media ) {
		res_styling_css += "@media only screen and " + media + " {";
		res_styling_css += gen_styling_css;
		res_styling_css += "}";
		return res_styling_css;
	}

	return gen_styling_css;
}

export default generate_block_css
