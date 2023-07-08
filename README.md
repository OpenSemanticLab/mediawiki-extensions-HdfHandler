# HdfHandler

Mediahandler for HDF5 files

## Features

 * [Special page](https://www.mediawiki.org/wiki/Manual:Special_pages) (specials/SpecialHdfViewer.php)
 * [Parser hook](https://www.mediawiki.org/wiki/Manual:Parser_functions) (HdfHandler/HdfHandler.hooks.php)

Provides [silx-kit H5WasmApp](https://github.com/silx-kit/h5web/blob/c96cdab281998f43632f43cdefdda9ec16e6ae99/apps/demo/src/h5wasm/H5WasmApp.tsx) under `/w/extensions/HdfHandler/dist/`

Usage as static page `Special/HdfViewer/<optional_hdf_file_stored_in_the_wiki>.hdf`

Usage with [Extension:Iframe](https://github.com/sigbertklinke/Iframe)

in LocalSettings.php
```php
wfLoadExtension( 'Iframe' );
$wgIframe['width'] = "100%";
$wgIframe['server']['wiki'] = [ 'scheme' => 'https', 'domain' => '<your_wiki_domain>' ];
```

On any page
```html
<iframe key="wiki" path="w/extensions/HdfHandler/dist/?url=/w/index.php?title=Special:Redirect/file/<your_file>.hdf"/>
```


## Development

To build [silx-kit H5WasmApp](https://github.com/silx-kit/h5web/blob/c96cdab281998f43632f43cdefdda9ec16e6ae99/apps/demo/src/h5wasm/H5WasmApp.tsx) in `dist/`:

1. install nodejs (version 18)

```bash
git clone https://github.com/silx-kit/h5web
cd h5web
corepack enable
corepack prepare pnpm@8.6.0
```

1. change routes in `h5web/apps/demo/src/DemoApp.tsx` to

```tsx
...
function DemoApp() {
  return (
    <Router>
      <Routes>
        <Route path="/w/extensions/HdfHandler/dist/" element={<H5WasmApp />} />
        <Route path="h5grove" element={<H5GroveApp />} />
        <Route path="mock" element={<MockApp />} />
        <Route path="hsds" element={<HsdsApp />} />
        <Route path="h5wasm" element={<H5WasmApp />} />
        <Route path="*" element={<Navigate to="/w/extensions/HdfHandler/dist/" replace />} />
      </Routes>
    </Router>
  );
}
...
```

1. run

```bash
pnpm i
pnpm run build
```

1. make js/css paths in `h5web/apps/demo/dist/index.html` relative

```html
...
    <script type="module" crossorigin src="assets/index-4eb2c75a.js"></script>
    <link rel="stylesheet" href="assets/index-187c1b38.css">
...
```

1. optionally run `npx http-server` and navigate to `http://localhost:8080/apps/demo/dist/` for testing

1. copy `h5web/apps/demo/dist/` to `HdfHandler/dist/`