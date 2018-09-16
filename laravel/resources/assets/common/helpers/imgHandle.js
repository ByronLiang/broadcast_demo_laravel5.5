/**
 * https://github.com/blueimp/JavaScript-Load-Image
 * toData_url: (window.URL || window.webkitURL).createObjectURL(blob)
 */
const loadImage = require('blueimp-load-image/js/load-image');
require('blueimp-load-image/js/load-image-scale');
require('blueimp-canvas-to-blob/js/canvas-to-blob.min');

export default (file, options) => {
    return new Promise((resolve, reject) => {
        options.canvas = true;
        loadImage(file, (img) => img.toBlob((blob) => resolve(blob), 'image/jpeg', 1), options);
    });
};
