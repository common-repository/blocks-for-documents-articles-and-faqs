const path = require( 'path' );
const webpack = require( 'webpack' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );

// Set different CSS extraction for editor only and common block styles
const blocksCSSPlugin = new ExtractTextPlugin( {
  filename: './assets/css/blocks.style.css',
} );
const editBlocksCSSPlugin = new ExtractTextPlugin( {
  filename: './assets/css/blocks.editor.css',
} );
/*
const templateManagerCSSPlugin = new ExtractTextPlugin( {
  filename: './assets/css/admin-template-manager.css',
} );
*/
const pluginPagesCSSPlugin = new ExtractTextPlugin( {
  filename: './assets/css/admin-plugin-pages.css',
} );

// Configuration for the ExtractTextPlugin.
const extractConfig = {
  use: [
    { loader: 'raw-loader' },
    {
      loader: 'postcss-loader',
      options: {
        plugins: [ require( 'autoprefixer' ) ],
      },
    },
    {
      loader: 'sass-loader',
      query: {
        outputStyle:
          'production' === process.env.NODE_ENV ? 'compressed' : 'nested',
      },
    },
  ],
};

var defaults = {
  entry: {
    './assets/js/editor.blocks' : './blocks/index.js',
    './assets/js/frontend.blocks' : './blocks/frontend.js'
  },
  output: {
    path: path.resolve( __dirname ),
    filename: '[name].js',
  },
  watch: 'production' !== process.env.NODE_ENV,
  devtool: 'cheap-eval-source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /style\.s?css$/,
        use: blocksCSSPlugin.extract( extractConfig ),
      },
      {
        test: /editor\.s?css$/,
        use: editBlocksCSSPlugin.extract( extractConfig ),
      },
      {
        test: /backend\.s?css$/,
        use: editBlocksCSSPlugin.extract( extractConfig ),
      },
	  /*
      {
        test: /manager\.s?css$/,
        use: templateManagerCSSPlugin.extract( extractConfig ),
      },
	  */
      {
        test: /plugin-pages\.s?css$/,
        use: pluginPagesCSSPlugin.extract( extractConfig ),
      },
    ],
  },
  plugins: [
    blocksCSSPlugin,
    editBlocksCSSPlugin,
   // templateManagerCSSPlugin,
    pluginPagesCSSPlugin
  ],
};

// MINIFIED: Set different CSS extraction for editor only and common block styles
const blocksCSSPluginMIN = new ExtractTextPlugin( {
  filename: './assets/css/blocks.style.min.css',
} );
const editBlocksCSSPluginMIN = new ExtractTextPlugin( {
  filename: './assets/css/blocks.editor.min.css',
} );
/*
const templateManagerCSSPluginMIN = new ExtractTextPlugin( {
  filename: './assets/css/admin-template-manager.min.css',
} );
*/
const pluginPagesCSSPluginMIN = new ExtractTextPlugin( {
  filename: './assets/css/admin-plugin-pages.min.css',
} );

// Configuration for the ExtractTextPlugin.
const extractConfigMIN = {
  use: [
    { loader: 'raw-loader' },
    {
      loader: 'postcss-loader',
      options: {
        plugins: [ require( 'autoprefixer' ) ],
      },
    },
    {
      loader: 'sass-loader',
      query: {
        outputStyle: 'compressed',
      },
    },
  ],
};

var minified = {
  entry: {
    './assets/js/editor.blocks' : './blocks/index.js',
    './assets/js/frontend.blocks' : './blocks/frontend.js',
  },
  output: {
    path: path.resolve( __dirname ),
    filename: '[name].min.js',
  },
  watch: 'production' !== process.env.NODE_ENV,
  devtool: 'eval',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /style\.s?css$/,
        use: blocksCSSPluginMIN.extract( extractConfigMIN ),
      },
      {
        test: /editor\.s?css$/,
        use: editBlocksCSSPluginMIN.extract( extractConfigMIN ),
      },
      {
        test: /backend\.s?css$/,
        use: editBlocksCSSPluginMIN.extract( extractConfigMIN ),
      },
	  /*
      {
        test: /manager\.s?css$/,
        use: templateManagerCSSPluginMIN.extract( extractConfigMIN ),
      },
	  */
      {
        test: /plugin-pages\.s?css$/,
        use: pluginPagesCSSPluginMIN.extract( extractConfigMIN ),
      },
    ],
  },
  plugins: [
    blocksCSSPluginMIN,
    editBlocksCSSPluginMIN,
    //templateManagerCSSPluginMIN,
    pluginPagesCSSPluginMIN,
	
	new webpack.optimize.UglifyJsPlugin({
		compress: {
			warnings: false,
			drop_console: false,
		}
	}),
  ],
};

var simpleJS = {
  entry: {
    './assets/js/admin-plugin-pages' : './assets/js/admin-plugin-pages.js'
  },
  output: {
    path: path.resolve( __dirname ),
    filename: '[name].min.js',
  },
  watch: 'production' !== process.env.NODE_ENV,
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
        },
      },
    ],
  },
  plugins: [
	new webpack.optimize.UglifyJsPlugin({
		compress: {
			warnings: false,
			drop_console: false,
		}
	}),
  ],
};


module.exports = [defaults, minified, simpleJS];
