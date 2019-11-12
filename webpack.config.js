const path = require("path");

// plugins
const globImporter = require("node-sass-glob-importer");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const BundleAnalyzerPlugin = require("webpack-bundle-analyzer")
  .BundleAnalyzerPlugin;
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

/**
 * Setup
 */
const setup = {
  themeDirName: "theme-folder-name",
  url: "https://wp-starter.localhost",
  analyzeBundle: false,
  browserSync: true,
  showPerformanceHints: false
};

// stop editing

const themePath = path.resolve(
  __dirname,
  `public/wp-content/themes/${setup.themeDirName}`
);

module.exports = (env, argv) => {
  const devMode = argv.mode !== "production";

  let plugins = [
    new MiniCssExtractPlugin({
      filename: "styles/style.css"
    })
  ];

  if (setup.analyzeBundle && !devMode) {
    plugins.push(new BundleAnalyzerPlugin());
  }

  if (setup.browserSync && devMode) {
    plugins.push(
      new BrowserSyncPlugin({
        open: false,
        host: setup.url.replace(/^https?:\/\//, ""),
        proxy: setup.url,
        https: true,
        files: [`${themePath}/**/*`]
      })
    );
  }

  return {
    entry: `${themePath}/_src/scripts/index.js`,
    output: {
      path: `${themePath}/assets/`,
      filename: "scripts/main.js"
    },
    resolve: {
      modules: ["node_modules"],
      alias: {
        "@scripts": `${themePath}/_src/scripts`,
        "@styles": `${themePath}/_src/styles`,
        "@components": `${themePath}/components`
      }
    },
    performance: {
      hints: setup.showPerformanceHints
    },
    plugins: plugins,
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: "babel-loader",
            options: {
              presets: ["@babel/preset-env"],
              plugins: ["import-glob"]
            }
          }
        },
        {
          test: /\.(sa|sc|c)ss$/,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
              options: {
                hmr: devMode
              }
            },
            "css-loader?-url",
            {
              loader: "postcss-loader",
              options: {
                plugins: [require("cssnano"), require("autoprefixer")]
              }
            },
            {
              loader: "sass-loader",
              options: {
                sassOptions: {
                  importer: globImporter()
                }
              }
            }
          ]
        }
      ]
    }
  };
};
